<?php

    include "../connection.php";
    session_start();
    

        // Change status of request from candidate
    if(isset($_GET['exam'])){
        $exam = $_GET['exam'];
        $update_exam_query = "UPDATE nomrequest SET EXAM = 1 WHERE ID =".$exam;
        mysqli_query($conn, $update_exam_query);
        
        header("Location: ../../dashboard/candidate.php");
        exit();
    }

    if(isset($_GET['paid'])){
        $paid = $_GET['paid'];
        $update_paid_query = "UPDATE nomrequest SET ISPAID = 1 WHERE ID = '$paid'";
        mysqli_query($conn, $update_paid_query);

        header("Location: ../../dashboard/candidate.php");
        exit();
    }

    if(isset($_GET['accepted'])){
        $accepted = $_GET['accepted'];
        $userId = $_GET['userId'];
        $update_accepted_query = "UPDATE nomrequest SET ACCEPTED = 1 WHERE ID = '$accepted'";
        mysqli_query($conn, $update_accepted_query);

        $be_candidate_query = "UPDATE user SET ROLEID = 1 WHERE ID= '$userId'";
        mysqli_query($conn, $be_candidate_query);
        
        $add_empty_program_query = "INSERT INTO `electionprogram`(`PROFILE`, `DESCRIPTION`, `WEBSITE`, `USERID`) VALUES ('','','','".$userId."')";
        mysqli_query($conn, $add_empty_program_query);

        header("Location: ../../dashboard/candidate.php");
        exit();
    }

    // accept list
    if(isset($_GET['list_id'])) {
        $list_id = $_GET['list_id'];
     
        if($list_id) {
    
            $update_accepted_query = "UPDATE `list` SET `ACCEPTED`= 1 WHERE ID = $list_id";
            $update_list =  mysqli_query($conn,$update_accepted_query);
            
            header("Location: ../../dashboard/list.php?dash=true");
            exit();
        }
    }

    if(isset($_GET['setlist'])){
        
        $list_ID = $_POST['list_id'];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if any user is selected
            if (isset($_POST['selected_users']) && is_array($_POST['selected_users'])) {
                foreach ($_POST['selected_users'] as $user_id) {
                    // Update the LISTID for selected users
                    $update_query = "UPDATE user SET LISTID = '$list_ID' WHERE ID = '$user_id'";
                    mysqli_query($conn, $update_query);
                }
            }
    
            header("Location: ../../dashboard/list.php?dash=true");
            exit();
        }
    }
    
    if(isset($_GET['start'])) {
        $update_program = "UPDATE celebration SET STARTDATE = '1'";
        $election_program = mysqli_query($conn, $update_program);
        header("location: ../../dashboard/analycis.php?res=true");
        exit();
    }

    if(isset($_GET['end'])) {
        $update_program = "UPDATE celebration SET ENDED = '1'";
        $election_program = mysqli_query($conn, $update_program);

        header("location: ../../dashboard/analycis.php?res=true");
        exit();
    }

       

?>