<?php
   session_start();
   if(isset($_SESSION["USER"])){
       if($_GET['p200']) {
           header('location: ../../components/pages/200.html');
           session_destroy();
       } else {
            header('location: ../../index.php');
            session_destroy();
       }  
   }
   else{
       header('location:  ../../dashboard/analycis.php');
   }
?>