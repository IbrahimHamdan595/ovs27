<?php 
    $get_list_users_query = "SELECT 
    user.ID as ID, user.FIRSTNAME, user.MIDDLENAME, user.LASTNAME,
    user.MOTHERNAME, user.GENDER, user.DOB, user.REGISTERID, user.CENTERID,
    user.LISTID, user.ROLEID, user.VOTED, user.PASSWORD, register.RECORDID, record.NAME as record_name, 
    record.SMALLAREAID, smallarea.NAME as small_area_name, smallarea.BIGAREAID, smallarea.PRIORITY, smallarea.SEATS_NUMBER,
    bigarea.NAME as big_area_name, electionprogram.PROFILE, electionprogram.DESCRIPTION, electionprogram.WEBSITE
    FROM user
    JOIN electionprogram ON user.ID = electionprogram.USERID
    JOIN register ON user.REGISTERID = register.ID
    JOIN record ON register.RECORDID = record.ID
    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
    JOIN list on list.ID = user.LISTID
    WHERE user.LISTID =". $dlist['ID']. "
    ORDER BY smallarea.priority ASC, bigarea.NAME ASC";
    $get_list_users =  mysqli_query($conn,$get_list_users_query);
    
    echo "    
        <div class='card list-card d-flex flex-column m-2' style='background:".$dlist['COLOR'].";width: 300px'>
        <div class='pt-4'>
        <h3 class='d-flex flex-row'>
        <div class='mr-2' style='background: ". $dlist['COLOR']."; width: 20px; height: 20px'></div>
                <b class='text-white'> ".$dlist['NAME']." </b>
            </h3>
            <hr>
        </div>";

        while($list_users = mysqli_fetch_assoc($get_list_users)) {
            echo "
            <div class='d-flex flex-row p-4 align-items-end'>
                <img class='' src='".$list_users['PROFILE']."'/>
                <div class='d-flex align-items-center px-1 ml-1 flex-grow-1' style='background: white;height: 50px;'>".$list_users['FIRSTNAME']." ".$list_users['MIDDLENAME']." ".$list_users['LASTNAME']."</div>
            </div>";
        }
     echo "<a class='p-4 text-red btn btn-outline-light' href='../Logic/queries/delete.php?leave=".$user['ID']."'>Leave the List</a>"; 
     echo "</div>";


 ?>