<?php

    $list_query = "SELECT * FROM list"; 
    $get_list =  mysqli_query($conn,$list_query);
  
    $big_area_query = "SELECT * FROM bigarea"; 
    $get_big_area =  mysqli_query($conn,$big_area_query);

    $get_celebration_query = "SELECT * from celebration where ID = 1";
    $get_celebration =  mysqli_query($conn, $get_celebration_query);

    $get_election_program_query = "SELECT * FROM electionprogram";
    $get_election_program = mysqli_query($conn, $get_election_program_query);

    $get_all_user_query = "SELECT user.*, register.REGISTERNUM, center.NAME as center_name, smallarea.NAME AS small_area_name, bigarea.NAME AS big_area_name, record.NAME AS record_name
    FROM user
    JOIN center ON user.CENTERID = center.ID
    JOIN register ON user.REGISTERID = register.ID
    JOIN record ON register.RECORDID = record.ID
    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID";  
    $get_all_user = mysqli_query($conn, $get_all_user_query);

    $get_nom_request_query = " SELECT * FROM  nomrequest";
    $get_nom_request = mysqli_query($conn, $get_nom_request_query);

    // Define the number of results per page
    $results_per_page = 32;

    // Capture search input from the user
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

    // Modify the query to include the filter condition
    $search_query = "";
    if (!empty($search)) {
        $search_query = " AND (user.FIRSTNAME LIKE '%$search%' OR user.MIDDLENAME LIKE '%$search%' OR user.LASTNAME LIKE '%$search%' OR user.MOTHERNAME LIKE '%$search%' OR bigarea.NAME LIKE '%$search%' OR smallarea.NAME LIKE '%$search%' OR record.NAME LIKE '%$search%' OR register.REGISTERNUM LIKE '%$search%' OR center.NAME LIKE '%$search%')";
    }

    // Find out the number of total records after filtering
    $total_query = "SELECT COUNT(user.ID) AS total FROM user 
    JOIN center ON user.CENTERID = center.ID
    JOIN register ON user.REGISTERID = register.ID
    JOIN record ON register.RECORDID = record.ID
    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID 
    WHERE user.ROLEID != 2" . $search_query;
    $total_result = mysqli_query($conn, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_records = $total_row['total'];

    // Calculate the total number of pages
    $total_pages = ceil($total_records / $results_per_page);

    // Determine which page number visitor is currently on
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

    // Determine the starting limit number
    $starting_limit = ($page - 1) * $results_per_page;

    // Retrieve the selected results from the database with filter and pagination
    $query = "SELECT user.*, register.REGISTERNUM, center.NAME as center_name, smallarea.NAME AS small_area_name, bigarea.NAME AS big_area_name, record.NAME AS record_name
        FROM user
        JOIN center ON user.CENTERID = center.ID
        JOIN register ON user.REGISTERID = register.ID
        JOIN record ON register.RECORDID = record.ID
        JOIN smallarea ON record.SMALLAREAID = smallarea.ID
        JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID 
        WHERE user.ROLEID != 2" . $search_query . " LIMIT $starting_limit, $results_per_page";
    $result = mysqli_query($conn, $query);

?>