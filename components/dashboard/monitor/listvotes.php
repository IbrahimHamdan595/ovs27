<?php
include "../../../Logic/connection.php";

// Assuming $dlist['ID'] is available here, otherwise pass it as a query parameter.
$dlistID = $_GET['dlistID'];  // Get the dlist ID from the request

$query = "SELECT VOTESNUM FROM list WHERE ID = $dlistID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo $row['VOTESNUM'];
?>