import pandas as pd
import mysql.connector
from mysql.connector import Error
from sqlalchemy import insert, create_engine, Table, MetaData

# Define the connection parameters
server = "localhost"
username = "root"
password = ""
db_name = "ovs27"

# SQL queries
get_candidate = """
SELECT 
    user.ID as id, user.REGISTERID as register_id, user.LISTID as list_id, user.ROLEID as role_id, register.ID AS register_id, smallarea.ID as small_area_id
FROM user
JOIN register ON user.REGISTERID = register.ID
JOIN record ON register.RECORDID = record.ID
JOIN smallarea ON record.SMALLAREAID = smallarea.ID
WHERE user.ROLEID = 1 and user.LISTID is not NULL;
"""
get_small_area = """
SELECT `ID` as small_area_id, `BIGAREAID` as big_area_id, `PRIORITY` as priority, `SEATS_NUMBER` as seats_num FROM `smallarea`
"""
get_box = """
SELECT ID as id, USERID AS user_id , VOTENUMBER as vote_number_result FROM `box`
"""
get_big_area = """
SELECT ID as big_area_id FROM `bigarea`
"""
get_list_votes = """
SELECT ID as list_id, VOTESNUM as votes_number FROM `list`
"""
get_total_seats_for_each_area = """
SELECT SUM(SEATS_NUMBER) AS total_seats FROM smallarea WHERE BIGAREAID = %s
"""

def get_total_seats(cursor, big_area_id):
    cursor.execute(get_total_seats_for_each_area, (big_area_id,))
    result = cursor.fetchone()
    if result and result['total_seats'] is not None:
        return result['total_seats']
    return 0  # Default to 0 if no seats found

# SQL query to get total votes per list for a specific big area
get_total_votes_per_list_query = """
SELECT list.ID as list_id, VOTESNUM as votes_number 
FROM `list`
JOIN user ON user.LISTID = list.ID
JOIN register ON user.REGISTERID = register.ID
JOIN record ON record.ID = register.RECORDID
JOIN smallarea ON smallarea.ID = record.SMALLAREAID
JOIN bigarea ON bigarea.ID = smallarea.BIGAREAID
WHERE bigarea.ID = %s 
GROUP BY list.ID
"""

def get_total_votes_per_list(cursor, big_area_id):
    cursor.execute(get_total_votes_per_list_query, (big_area_id,))
    results = cursor.fetchall()
    if results:
        list_votes_df = pd.DataFrame(results)
        total_votes_per_list = list_votes_df.set_index('list_id')['votes_number']
        return total_votes_per_list
    return pd.Series()  # Return an empty Series if no data is found

try:
    # Establish the connection
    connection = mysql.connector.connect(
        host=server,
        user=username,
        password=password,
        database=db_name
    )

    if connection.is_connected():
        print("Successfully connected to the database")

        # Create a cursor to execute the queries
        cursor = connection.cursor(dictionary=True)

        # Execute and fetch all queries
        cursor.execute(get_candidate)
        data = cursor.fetchall()
        cursor.execute(get_small_area)
        small_area_data = cursor.fetchall()
        cursor.execute(get_box)
        box_data = cursor.fetchall()
        cursor.execute(get_big_area)
        big_area_data = cursor.fetchall()
        cursor.execute(get_list_votes)
        list_votes_data = cursor.fetchall()

    # Create DataFrames
    merged_df = pd.DataFrame(data)
    small_area_df = pd.DataFrame(small_area_data)
    big_area_df = pd.DataFrame(big_area_data)
    box_df = pd.DataFrame(box_data)
    list_votes_df = pd.DataFrame(list_votes_data)

    # Add a new column to store total seats
    big_area_df['total_seats'] = None

    # Iterate over the big_area_df DataFrame
    for index, row in big_area_df.iterrows():
        big_area_id = row['big_area_id']
        total_seats = get_total_seats(cursor, big_area_id)
        big_area_df.at[index, 'total_seats'] = total_seats

        # Calculate total votes per list
        total_votes_per_list = get_total_votes_per_list(cursor, big_area_id)
        total_votes_per_big_area= 0
        total_votes_per_big_area = total_votes_per_list.sum()

        # Calculate the quotient of all lists
        first_quotient_lists = total_votes_per_big_area / total_seats
        
        # Compare total votes per list with the quotient
        first_result = total_votes_per_list[total_votes_per_list >= first_quotient_lists]

        # Get the failed lists (lists with total votes less than the quotient)
        failed_lists = total_votes_per_list[total_votes_per_list < first_quotient_lists]

        # Get the total vote numbers of the failed lists
        failed_lists_total_votes = failed_lists.sum()

        # Calculate the difference between total votes and total votes per list
        second_quotient_lists = (total_votes_per_big_area - failed_lists_total_votes) / total_seats

        # Return the division result
        division_result = first_result / second_quotient_lists

        # Calculate the fractional part of the division result
        fractional_part = division_result - division_result.astype(int)

        # Sort the lists by their fractional part in descending order
        sorted_lists_by_fractional = fractional_part.sort_values(ascending=False)

        # Get the integer part of the division result
        seat_number_of_each_list = division_result.astype(int)
        
        repeat = total_seats - seat_number_of_each_list.sum()
        
        # Get the index of the list with the highest fractional part
        for index in range(int(repeat)):
            index_of_winner = sorted_lists_by_fractional.index[index]
            # Replace the list with the highest fractional part with index_of_winner
            seat_number_of_each_list[index_of_winner] += 1

        # # Merge the total votes for each combination with the box_df DataFrame
    box_df = pd.merge(box_df, merged_df[['id','small_area_id', 'list_id']], left_on='user_id', right_on='id', how='left')
    

    for index, row in big_area_df.iterrows():

        # Group box_df by small_area_id and calculate the sum of vote_number_result
        sum_of_votes_per_small_area = box_df.groupby('small_area_id')['vote_number_result'].sum()

        # Merge the sum_of_votes_per_small_area back into box_df
    box_df = pd.merge(box_df, sum_of_votes_per_small_area, on='small_area_id', suffixes=('', '_sum'))

    # Calculate the percentage of vote_number_result for each candidate
    box_df['percentage_of_votes_per_small_area'] = (box_df['vote_number_result'] / box_df['vote_number_result_sum']) * 100

    # Sort candidates within each list by vote_number_result_sum
    box_df['rank_within_list'] = box_df.groupby('list_id')['percentage_of_votes_per_small_area'].rank(ascending=False)

    # Sort candidates within each small area by vote_number_result_sum
    box_df['rank_within_small_area'] = box_df.groupby('small_area_id')['percentage_of_votes_per_small_area'].rank(ascending=False)

    # Merge the box_df DataFrame with the small_area_df DataFrame to get the rank_within_small_area for each user_id
    merged_box_small_area_df = pd.merge(box_df, small_area_df[['small_area_id', 'seats_num']], on='small_area_id', how='left')

    # Sort the merged DataFrame by small_area_id and rank_within_small_area
    merged_box_small_area_df.sort_values(by=['small_area_id', 'rank_within_small_area'], inplace=True)

    # Create an empty DataFrame to store the distribution of user_ids among seats
    seats_distribution_df = pd.DataFrame(columns=['small_area_id', 'seat_number', 'user_id'])
    print(seats_distribution_df)

    # Initialize an empty list to store the data
    seats_distribution_data = []

    # Create a dictionary to map user_id to list_id
    user_to_list_mapping = merged_box_small_area_df.set_index('user_id')['list_id'].to_dict()

    # Iterate over each small area
    for small_area_id, small_area_data in merged_box_small_area_df.groupby('small_area_id'):
        # Get the number of seats for the current small area and cast it to integer
        seats_num = int(small_area_data.iloc[0]['seats_num'])

        # Sort candidates within each small area by rank_within_small_area
        small_area_data.sort_values(by='rank_within_small_area', inplace=True)

        # Assign seats to candidates based on their rank and the number of seats allocated to the list
        for seat_number, user_id in enumerate(small_area_data['user_id'].iloc[:seats_num], start=1):
            # Get the list_id corresponding to the user_id
            user_list_id = user_to_list_mapping.get(user_id, None)
           # Append the user_id, list_id, seat_allocation, and list_seats_num to the list of data
            seats_distribution_data.append({
                'small_area_id': small_area_id,
                'seat_number': seat_number,
                'user_id': user_id,
                'list_id': user_list_id
            })

    # Create the seats_distribution_df DataFrame from the list of data
    seats_distribution_df = pd.DataFrame(seats_distribution_data)

    # Display the resulting DataFrame
    # print("\nSeats Distribution DataFrame:")
    # print(seats_distribution_df)



    # Create the SQLAlchemy database URL
    database_url = f"mysql+mysqlconnector://{username}:{password}@{server}/{db_name}"

    engine = create_engine(database_url)
    # Use pandas to_sql method to insert the DataFrame into the 'result' table
    seats_distribution_df.to_sql('result', con=engine, if_exists='append', index=False)

except Error as e:
    print(f"Error: {e}")

finally:
    # Close the cursor and connection if they were opened
    if 'cursor' in locals() and cursor:
        cursor.close()
    if connection.is_connected():
        connection.close()
        print("Database connection closed")
