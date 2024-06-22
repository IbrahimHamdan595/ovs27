<?php 

    $user = $_SESSION['USER'];

    $get_voting_list_query = "SELECT 
    user.ID as USERID, user.FIRSTNAME, user.MIDDLENAME, user.LASTNAME,
    user.MOTHERNAME, user.GENDER, user.DOB, user.REGISTERID, user.CENTERID,
    user.LISTID, user.ROLEID, user.VOTED, user.PASSWORD, register.RECORDID, record.NAME as record_name, 
    record.SMALLAREAID, smallarea.NAME as small_area_name, smallarea.BIGAREAID, smallarea.PRIORITY, smallarea.SEATS_NUMBER,
    bigarea.NAME as big_area_name, electionprogram.PROFILE
    FROM user
    JOIN electionprogram ON user.ID = electionprogram.USERID
    JOIN register ON user.REGISTERID = register.ID
    JOIN record ON register.RECORDID = record.ID
    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
    JOIN list on list.ID = user.LISTID
    WHERE user.LISTID =". $dlist['ID']. "
    ORDER BY smallarea.priority ASC, bigarea.NAME ASC";
    
    $get_voting_list =  mysqli_query($conn,$get_voting_list_query);
    
    if ($user) {
        if ($dlist['BIGAREA'] == $blist['ID']) {
            echo "
                <div class='card list-card d-flex flex-column m-2' style='background:".$dlist['COLOR'].";width: 300px'>
                    <div class='pt-4'>
                        <h3 class='d-flex flex-row justify-content-between px-2'>
                            <label for='listCheck'>
                            <b class='text-white'> ".$dlist['NAME']." </b>
                            </label>
                            <input style='width:25px; height: 25px; display: block' type='radio' value='l".$dlist['ID']."' name='check' id='listCheck'>       
                        </h3>
                    <hr>
                </div>
            ";
 
        while($voting_list = mysqli_fetch_assoc($get_voting_list)) {
            echo "
                <div class='d-flex flex-row justify-content-around p-2 align-items-end'>
                    <img class='' src='".$voting_list['PROFILE']."'/>
                <div class='d-flex align-items-center px-1 ml-1 flex-grow-1' style='background: white;height: 50px;'>".$voting_list['FIRSTNAME']." ".$voting_list['MIDDLENAME']." ".$voting_list['LASTNAME']."</div>        
                ";
            if ($voting_list['small_area_name'] == $user['small_area_name']) {
                echo "<input style='border: none; width:50px; height: 50px; display: block' class='ml-2' type='radio' value='".$voting_list['USERID']."' name='check' id='nameCheck'/>";
            }else{
                echo "<input disabled style='border: none; width:50px; height: 50px; display: block' class='ml-2' type='radio' name='check' id='nameCheck'/>";
            }
            echo "</div>";
        }
  echo "</div>";
    }

 ?>

<?php 

    }else {
        header("Location: ../../index.php");
    }?>