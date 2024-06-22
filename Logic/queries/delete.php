<?php
    include "../connection.php";
    session_start();

    $user = $_SESSION["USER"];

    // To Leave from the List
    if (!empty($_GET['leave'])) {
        $leave_query = "UPDATE `user` SET `LISTID`= NULL WHERE ID= ". $_GET['leave'];
        $leave_list =  mysqli_query($conn,$leave_query);
        
        unset($user['LISTID']);
        $user['LISTID'] = NULL;

        if (empty($user['LISTID'])) {
            header("Location: ../../dashboard/list.php");
            exit();
        }
    }
    // To delete request from voter to be a candidate
    if (!empty($_GET['c_rejects'])) {
        $delete_request_from_candidate = "DELETE FROM `nomrequest` WHERE ID= ". $_GET['c_rejects'];
        $delete_request =  mysqli_query($conn, $delete_request_from_candidate);
        
        header("Location: ../../dashboard/candidate.php");
        exit();
    }

    if (!empty($_GET['c_delete']) && !empty($_GET['c_userId'])) {

        $c_delete = intval($_GET['c_delete']);
        $c_userId = intval($_GET['c_userId']);
        
        $delete_request_from_candidate = "DELETE FROM `nomrequest` WHERE ID= ". $c_delete;
        $delete_request =  mysqli_query($conn, $delete_request_from_candidate);

        $update_role_id_query = "UPDATE user SET ROLEID = 3 WHERE ID= ". $c_userId;
        mysqli_query($conn, $update_role_id_query);

        
        header("Location: ../../dashboard/candidate.php");
        exit();
    }

    // To delete a accepted list

    $listID = $_GET['listId'];

    if(!empty($_GET['listId'])) {
        
        $delete_list_query = "DELETE FROM `list` WHERE ID = ". $listID;
        $delete_list =  mysqli_query($conn,$delete_list_query);

        header("Location: ../../dashboard/list.php");
        exit();
    }

?>