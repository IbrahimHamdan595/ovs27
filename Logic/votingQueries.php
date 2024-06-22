<?php 

    include "./connection.php";
    session_start();


    $user = $_SESSION['USER'];
    $vote = $_POST['check'];

    if($vote) {
        //teswit lal le2iha (iza sawat lal le2iha)
        //VALUE= "L+ $LISTID" YE3NI LAL LE2IHA
        if (strtolower(substr($vote, 0, 1)) === 'l') {
            //CHIL HARF "L" MN VALUE L CHECK 
            $vote = str_replace('l', '', $vote);
            
            // //GET LIST BA3ED MA FELTARNA HARF "L"
            $get_list_query = "SELECT * FROM list WHERE ID=". $vote;
            $get_list = mysqli_query($conn,$get_list_query);  
            $list = mysqli_fetch_assoc($get_list);

            // //ZED SOT LAL LIST
            $update_list_votes_query = "UPDATE `list` SET `VOTESNUM`= " . ($list['VOTESNUM'] + 1) . " WHERE ID=" . $vote;
            $update_list_votes = mysqli_query($conn,$update_list_votes_query);

            if($update_list_votes) {
                $update_user_status_query = "UPDATE `user` SET `VOTED`= 1 WHERE ID = ".$user['ID'];
                $update_vote = mysqli_query($conn, $update_user_status_query);
                $user['VOTED'] = 1;
            }
            
        } 
        //teswit lal le2iha + l chakhes (iza sawat lal chakhes)
        else {
            
            $get_box_query = "SELECT box.*, user.LISTID FROM `box` JOIN user on user.ID = box.USERID WHERE USERID=". $vote;
            $get_box = mysqli_query($conn,$get_box_query);
            $box = mysqli_fetch_assoc($get_box);
                
            $get_list_query = "SELECT * FROM list WHERE ID=". $box['LISTID'];
            $get_list = mysqli_query($conn,$get_list_query);  
            $list = mysqli_fetch_assoc($get_list);
            
            //ZED SOT LAL LIST
            
            $update_list_votes_query = "UPDATE `list` SET `VOTESNUM`= " . ($list['VOTESNUM'] + 1) . " WHERE ID=" . $list['ID'];
            $update_list_votes = mysqli_query($conn,$update_list_votes_query);
            
            if($user['VOTED'] == 0) {
                // insert to box if there is not an user
                if (empty($box)) {
                    $insert_box_query = "INSERT INTO `box`(`VOTENUMBER`, `USERID`, `DATE`) VALUES ('1','".$vote."','2024-05-20')";
                    $insert_box = mysqli_query($conn,$insert_box_query);
                    
                    if($insert_box) {
                        $update_user_status_query = "UPDATE `user` SET `VOTED`= 1 WHERE ID = ".$user['ID'];
                        $update_vote = mysqli_query($conn, $update_user_status_query);
                        $user['VOTED'] = 1;
                    }
                    
                }else {
                    $update_box_query = "UPDATE `box` SET `VOTENUMBER`= ".($box['VOTENUMBER']+ 1) ." WHERE USERID = ".$vote;
                    $update_box = mysqli_query($conn, $update_box_query);
                    
                    if($update_box) {   
                        $update_user_status_query = "UPDATE `user` SET `VOTED`= 1 WHERE ID = ".$user['ID'];
                        $update_vote = mysqli_query($conn, $update_user_status_query);
                        $user['VOTED'] = 1;
                    }
                }
            }
        }   
        header('Location: ./auth/logout.php?p200=true'); 
        exit();
    }
?>