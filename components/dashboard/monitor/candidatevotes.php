<?php
include "../../../Logic/connection.php";

// Assuming $userID is available here, otherwise pass it as a query parameter.
$userID = $_GET['userID'];  // Get the user ID from the request

$query = "SELECT VOTENUMBER FROM BOX WHERE USERID = $userID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo "
    <div class='d-flex align-items-center px-2 ml-1 bg-light' id='candidatevotes' style='height: 50px;'>".$row['VOTENUMBER']."</div>
";
?>