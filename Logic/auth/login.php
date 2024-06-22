<?php

// Include the database connection file
include "../connection.php";
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID and password from POST data
    $userId = $_POST["userId"];
    $password = $_POST["password"];

    // Validate user ID and password (you can add more validation logic here)
    if (empty($userId) || empty($password)) {
        // Handle empty fields
        $error = "Please enter both user ID and password.";
    } else {
        // Perform database query to check if user credentials are valid
        // Assuming you have a database connection, replace 'your_database' with your actual database name
        // $conn = mysqli_connect("localhost", "username", "password", "your_database");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare SQL statement to fetch user data based on user ID
        $sql = "SELECT 
        user.ID as ID, user.FIRSTNAME, user.MIDDLENAME, user.LASTNAME,
        user.MOTHERNAME, user.GENDER, user.DOB, user.REGISTERID, user.CENTERID,
        user.LISTID, user.ROLEID, user.VOTED, user.PASSWORD, register.RECORDID, register.REGISTERNUM, record.NAME as record_name, 
        record.SMALLAREAID, smallarea.NAME as small_area_name, smallarea.BIGAREAID, smallarea.PRIORITY, smallarea.SEATS_NUMBER,
        bigarea.NAME as big_area_name
        FROM user JOIN register ON user.REGISTERID = register.ID
        JOIN record ON register.RECORDID = record.ID
        JOIN smallarea ON record.SMALLAREAID = smallarea.ID
        JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID WHERE user.ID = '$userId'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // User found, verify password
            $row = mysqli_fetch_assoc($result);

            $_SESSION["USER"] = $row;

            if ($password == $row["PASSWORD"]) {
                
            

                //admin and candidate go to dashboard not on process

                //not admin on process
                    //voted
                    //not voted
                if( $row['ROLEID'] != 2 && $_GET['process'] ) {
                    if($row['VOTED']==1){
                        header("Location: ../../components/pages/403.html");
                        exit();
                    }else {
                        header("Location: ../../voting/votingScreen.php");
                        exit();
                    }
                }else if($row['ROLEID'] != 3) {
                            header("Location: ../../dashboard/analycis.php");
                            exit();
                    }
                    // Password is correct, redirect user to dashboard or homepage
                }
             else {
                // Password is incorrect
                
                header("Location: ../../components/pages/404.html");
                exit();
            }
        } else {
            // User not found
            header("Location: ../../components/pages/404.html");
            exit();
        }

        // Close database connection
        mysqli_close($conn);
    }
}

    // header("Location: ../light/index.php");
    // exit();
?>