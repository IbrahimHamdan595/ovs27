<?php

    include "../connection.php";
    session_start();
    $user= $_SESSION['USER'];

    if(isset($_GET['image'])){

      // Check if the form was submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
       
         $targetDirectory = "uploads/"; // Directory to store uploaded images
         $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
         $uploadOk = true;
         $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
         $program_id = $_POST['program_id'];
 
         // Check if image file is a actual image or fake image
         $check = getimagesize($_FILES["image"]["tmp_name"]);
         if ($check === false) {
             echo "File is not an image.";
             $uploadOk = false;
         }
 
         // Check if file already exists
         if (file_exists($targetFile)) {
             echo "Sorry, file already exists.";
             $uploadOk = false;
         }
 
         // Check file size (you can adjust the size limit as needed)
         if ($_FILES["image"]["size"] > 500000) {
             echo "Sorry, your file is too large.";
             $uploadOk = false;
         }
 
         // Allow certain file formats
         if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             $uploadOk = false;
         }
 
         // Check if $uploadOk is set to false by an error
         if ($uploadOk === false) {
             echo "Sorry, your file was not uploaded.";
         } else {
             // If everything is ok, try to upload file
             if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                 echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                 // Here you can perform database operations to insert/update the image
                 $imagePath = $targetFile;
                 $sql = "UPDATE electionprogram SET PROFILE = '$imagePath' WHERE id =". $program_id;
                 $result = mysqli_query($conn, $sql);
 
                 header("Location: ../../dashboard/profile.php");
                 exit();  
                 
             } else {
                 echo "Sorry, there was an error uploading your file.";
             }
         }
     }
    }

    if(isset($_GET['program'])) {

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $program_id = $_POST['program_id'];
        $descriptions = $_POST['description'];
        $website = $_POST['website'];
        
        if(!empty($_POST['facebook_id'])) {
          $facebook_id= $_POST['facebook_id'];
        }
        
        if(!empty($_POST['instagram_id'])) {
          $instagram_id= $_POST['instagram_id'];
        }
        
        if(!empty($_POST['x_id'])) {
          $x_id= $_POST['x_id'];
        }
        
        if(!empty($_POST['linkedin_id'])) {
          $linkedin_id= $_POST['linkedin_id'];
        }
        
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $old_password = $_POST['old_password'];
        
        
        // Perform database update
        $update_program = "UPDATE electionprogram SET DESCRIPTION = '$descriptions', WEBSITE = '$website' WHERE ID =". $program_id;
        $election_program = mysqli_query($conn, $update_program);
        
        
        
        if(!empty($_POST['facebook'])) {
          $url_facebook = $_POST['facebook'];
          
          if(!empty($_POST['facebook_id'])){
            $update_url_facebook = "UPDATE url SET SRC = '$url_facebook' WHERE ID =". $facebook_id;
            $url_fac = mysqli_query($conn, $update_url_facebook);
          }else {
            $insert_url_facebook = "INSERT INTO `url`(`SRC`, `ELECTIONPROGRAMID`, `SOCIALMEDIAID`) VALUES ( '$url_facebook', $program_id, 2)"; 
            $url_fac = mysqli_query($conn, $insert_url_facebook);
          }
        }
        // echo $_POST['instagram_id'];
        
        if(!empty($_POST['instagram'])) {
          $url_instagram = $_POST['instagram'];
          
          if(!empty($_POST['instagram_id'])){
            $update_url_instagram = "UPDATE url SET SRC = '$url_instagram' WHERE ID =". $instagram_id;
            $url_inst = mysqli_query($conn, $update_url_instagram);
          }else {
            $insert_url_instagram = "INSERT INTO `url`(`SRC`, `ELECTIONPROGRAMID`, `SOCIALMEDIAID`) VALUES ( '$url_instagram', $program_id, 1)"; 
            $url_inst = mysqli_query($conn, $insert_url_instagram);
          }
          
        }
      
        if(!empty($_POST['x'])) {
        $url_x = $_POST['x'];
      
        if(!empty($_POST['x_id'])){
        $update_url_x = "UPDATE url SET SRC = '$url_x' WHERE ID =". $x_id;
        $url_x = mysqli_query($conn, $update_url_x);
        }else {
          $insert_url_x = "INSERT INTO `url`(`SRC`, `ELECTIONPROGRAMID`, `SOCIALMEDIAID`) VALUES ( '$url_x', $program_id, 3)"; 
          $url_x = mysqli_query($conn, $insert_url_x);
        }
      
        }
      
        
        if(!empty($_POST['linkedin'])) {
        $url_linkedin = $_POST['linkedin'];
      
          if(!empty($_POST['linkedin_id'])){
            $update_url_linkedin = "UPDATE url SET SRC = '$url_linkedin' WHERE ID =". $linkedin_id;
            $url_linkedin = mysqli_query($conn, $update_url_linkedin);
          }else {
            $insert_url_linkedin = "INSERT INTO `url`(`SRC`, `ELECTIONPROGRAMID`, `SOCIALMEDIAID`) VALUES ( '$url_linkedin', $program_id, 4)"; 
            $url_linkedin = mysqli_query($conn, $insert_url_linkedin);
          }
        }
      
      
        if($old_password){
          if($old_password == $user['PASSWORD']){
            if($new_password == $confirm_password) {
              $password_query = "UPDATE user SET PASSWORD = '$new_password' WHERE ID = ".$user['ID'];  
              $pass = mysqli_query($conn, $password_query);
              $_SESSION['USER']['PASSWORD'] = $new_password;
            }
          }
        }
        // Redirect the user back to the page or show a success message
        header("Location: ../../dashboard/profile.php");
        exit();
      }
    }
?>