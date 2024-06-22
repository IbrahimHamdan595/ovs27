<?php 
    include "../../../Logic/connection.php";

    $get_list_users_query = "SELECT *, user.ID as ID
    FROM user
    JOIN electionprogram ON user.ID = electionprogram.USERID
    JOIn box ON box.USERID = user.ID
    JOIN register ON user.REGISTERID = register.ID
    JOIN record ON register.RECORDID = record.ID
    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
    JOIN list on list.ID = user.LISTID
    WHERE user.LISTID =". $dlist['ID']. "
    ORDER BY smallarea.priority ASC, bigarea.NAME ASC";
    $get_list_users =  mysqli_query($conn,$get_list_users_query);
    
    
    if ($dlist['BIGAREA'] == $blist['ID'] ) {
      echo "
    <div class='card list-card d-flex flex-column m-2' style='background:".$dlist['COLOR'].";width: 300px'>
    <div class='pt-4'>
        <h3 class='d-flex flex-row justify-content-around'>
            <b class='text-white'> ".$dlist['NAME']." </b>
            <div class='d-flex align-items-center p-2 ml-1 bg-light' style='height: 30px;'>".$dlist['VOTESNUM']."</div>
       </h3>
       <hr>
    </div>
    ";

   

       while($rowlist = mysqli_fetch_assoc($get_list_users)) {
         echo "
         <div class='d-flex flex-row p-4 align-items-end'>
         <img class='' src='".$rowlist['PROFILE']."'/>
         <div class='d-flex align-items-center px-1 ml-1 flex-grow-1 bg-light' style='height: 50px;'>".$rowlist['FIRSTNAME']." ".$rowlist['MIDDLENAME']." ".$rowlist['LASTNAME']."</div>
         <div class='d-flex align-items-center px-2 ml-1 bg-light' style='height: 50px;'>".$rowlist['VOTENUMBER']."</div>
      </div>";
      
  }

  echo "</div>";


    }

 ?>