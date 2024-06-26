<?php
include "../../../Logic/connection.php";

// Assuming $dlist['ID'] is available here, otherwise pass it as a query parameter.
$dlistID = $_GET['dlistID'];  // Get the dlist ID from the request

$query = "SELECT VOTESNUM FROM list WHERE ID = $dlistID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);


echo "
    <div class='d-flex align-items-center p-2 ml-1 bg-light' id='listvotes' style='height: 30px;'>
        ".$row['VOTESNUM']."
    </div>
    ";
?>