<?php 
    include "../../../Logic/connection.php";

    $get_box_query= "SELECT box.VOTENUMBER, list.COLOR
    FROM user
    JOIN box on user.ID = box.USERID
    JOIN list on user.LISTID = list.ID
    JOIN register ON user.REGISTERID = register.ID
    JOIN record ON register.RECORDID = record.ID
    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
    WHERE user.ID =". $user['ID'];
    $get_box = mysqli_query($conn, $get_box_query);
    $box = mysqli_fetch_assoc($get_box);

echo "
<div style='width: 100%' class='d-flex justify-content-center'>
    <div style='background: ".$box['COLOR']."; border-radius:50%; width:30%; height:55vh'
        class='d-flex text-white font-weight-bold justify-content-center display-1 align-items-center'>
            ".$box['VOTENUMBER']."
    </div>
</div>";

?>