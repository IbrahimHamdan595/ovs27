<?php

    include "../connection.php";

    // To send request to be a candidate:
    $recordId = $_POST['Record_ID'];
    $userId = $_POST['ID'];

    // Handle file uploads
    $familyIdFile = $_FILES['FAMILYID'];
    $accountStatementFile = $_FILES['ACCOUNTSTATMENT'];
    $justiceRecordFile = $_FILES['JUSTICERECORD'];

    // Check if files are uploaded successfully
    if ($familyIdFile['error'] === UPLOAD_ERR_OK &&
        $accountStatementFile['error'] === UPLOAD_ERR_OK &&
        $justiceRecordFile['error'] === UPLOAD_ERR_OK) {
        
        // Move uploaded files to a desired location
        $familyIdPath = '../../uploads/' . $familyIdFile['name'];
        $accountStatementPath = '../../uploads/' . $accountStatementFile['name'];
        $justiceRecordPath = '../../uploads/' . $justiceRecordFile['name'];
        
        $familyIdPathDB = $familyIdFile['name'];
        $accountStatementPathDB = $accountStatementFile['name'];
        $justiceRecordPathDB = $justiceRecordFile['name'];

        move_uploaded_file($familyIdFile['tmp_name'], $familyIdPath);
        move_uploaded_file($accountStatementFile['tmp_name'], $accountStatementPath);
        move_uploaded_file($justiceRecordFile['tmp_name'], $justiceRecordPath);
        
        // Insert the data into the database
        $query = "INSERT INTO nomrequest (RECORDID, FAMILYID, ACCOUNTSTATMENT, JUSTICERECORD, USERID) 
                VALUES ('$recordId', '$familyIdPathDB', '$accountStatementPathDB', '$justiceRecordPathDB',  '$userId')";
        
        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Your request is on process");</script>';
    
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "File upload failed.";
    }

    header("Location: ../../index.php");
    exit();


?>