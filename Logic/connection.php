<?php
$server= "localhost";
$username= "root";
$password= "";
$db_name= "ovs27";

// $server= "localhost";
// $username= "u959456943.ovs27";
// $password= "I&s_5103";
// $db_name= "u959456943_ovs27";


$conn = mysqli_connect($server, $username, $password, $db_name);

if (!$conn) {
    echo "Connection failed!"; 
}

?>