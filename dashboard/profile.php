<?php
  session_start();
  include "../Logic/Connection.php";

  $user = $_SESSION["USER"];

  // location
  $get_location_query = "SELECT smallarea.NAME AS small_area_name, bigarea.NAME AS big_area_name, record.NAME AS record_name
  FROM user
  JOIN register ON user.REGISTERID = register.ID
  JOIN record ON register.RECORDID = record.ID
  JOIN smallarea ON record.SMALLAREAID = smallarea.ID
  JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
  WHERE user.ID =". $user['ID']; 

  $get_location = mysqli_query($conn, $get_location_query);
  $location = mysqli_fetch_assoc($get_location);

  if($user['ROLEID'] == 1){
  // program
  $get_program_sql = "SELECT * FROM electionprogram where electionprogram.USERID =". $user['ID'];

  $get_program = mysqli_query($conn, $get_program_sql);
  $program =  mysqli_fetch_assoc($get_program);
  
  // list
  $get_list_query =  "SELECT list.NAME AS list_name FROM user JOIN list ON user.LISTID = list.ID where user.ID =". $user['ID'];
  
  $get_list = mysqli_query($conn, $get_list_query);
  $list =  mysqli_fetch_assoc($get_list);
  
  // URL
  $get_url_query =  "SELECT * FROM url where url.ELECTIONPROGRAMID =". $program['ID'];
  
  $get_url = mysqli_query($conn, $get_url_query);
  
  // Initialize an empty array to store the fetched rows
$url_rows = array();

// Check if there are rows returned by the query
if ($get_url) {
    // Iterate over the result set and fetch each row as an associative array
    while ($row = mysqli_fetch_assoc($get_url)) {
        // Append the fetched row to the array
        $url_rows[] = $row;
    }
  }
}

  


  if ($user) {
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="vertical  light collapsed  ">
    <script>
    <?php echo "console.log(".$user['ID'].")"; ?>
    </script>
    <div class="wrapper">

        <!-- navbar -->
        <?php include "../components/dashboard/navigation/dashboardNavBar.php"; ?>
        <!-- side bar -->
        <?php include "../components/dashboard/navigation/dashboardSideBar.php"; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 col-xl-8">
                        <h2 class="h3 mb-4 page-title">Hello Mr.
                            <?php echo $user["FIRSTNAME"] ." ". $user["LASTNAME"];?></h2>

                        <div class="my-4">
                            <div class="form-group">
                                <label for="inputAddress5">Profile picture</label>
                                <form action="../Logic/uploadpicture.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="program_id" value="<?php echo $program['ID']; ?>">
                                    <input type="file" name="image" accept="image/*">
                                    <input type="submit" value="Upload">
                                </form>
                            </div>
                            <form method="post" action="../Logic/updateprogram.php">
                                <div class="row mt-5 align-items-center">
                                    <div class="col-md-3 text-center mb-5">
                                        <div class="avatar avatar-xl">
                                            <img src="<?php echo $program['PROFILE'];?>" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row align-items-center">
                                            <div class="col-md-7">
                                                <h4 class="mb-1">
                                                    <?php echo $user["FIRSTNAME"] ." ". $user["MIDDLENAME"]." ". $user["LASTNAME"];?>
                                                </h4>
                                                <p class="small mb-3">
                                                    <span class="badge badge-dark">
                                                        <?php echo $location["big_area_name"].", ".$location["small_area_name"]; ?>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row mb-4">

                                            <div class="col">
                                                <p class="small mb-0 text-muted">
                                                    <?php echo $user["REGISTERNUM"].", ".$location["record_name"];?></p>
                                                <?php 
                                                if( $user['ROLEID'] == 1){
                                                    if($list) {
                                                        echo "<p class='small mb-0 text-muted'>".$list['list_name']."</p>";
                                                    }
                                                }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">

                                <?php if($user['ROLEID'] == 1) { ?>
                                <div class="form-group">
                                    <input type="hidden" name="program_id" value="<?php echo $program['ID']; ?>">
                                    <label for="inputEmail4">Description</label>
                                    <input type="text" class="form-control" id="inputEmail4"
                                        placeholder="Put a description about your program" name="description"
                                        value="<?php echo $program['DESCRIPTION'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress5">Website</label>
                                    <input type="text" class="form-control" id="inputAddress5"
                                        placeholder="Your website  .com" name="website"
                                        value="<?php echo $program['WEBSITE'];?>">
                                </div>


                                <div class="form-row">
                                    <?php
                      foreach ($url_rows as $url) {
                        if($url['SOCIALMEDIAID']==1){
                          echo "<input type='hidden' name='instagram_id' value='".$url['ID']."'>";
                        }else  if($url['SOCIALMEDIAID']==2){
                          echo "<input type='hidden' name='facebook_id' value='".$url['ID']."'>";
                        }else  if($url['SOCIALMEDIAID']==4){
                          echo "<input type='hidden' name='linkedin_id' value='".$url['ID']."'>";
                        }else if($url['SOCIALMEDIAID']==3){
                          echo "<input type='hidden' name='x_id' value='".$url['ID']."'>";
                        }
                    }
                    ?>



                                    <div class='form-group col-md-3'>
                                        <label for='url1'>Facebook</label>
                                        <input type='text' class='form-control' id='url1' placeholder='https://'
                                            name='facebook'
                                            value='<?php if(!empty($url_rows)){foreach($url_rows as $url){if($url['SOCIALMEDIAID']==2){echo $url['SRC'];break;}}}else{echo "https://";}?>'>
                                    </div>

                                    <div class='form-group col-md-3'>
                                        <label for='url4'>Linkedin</label>
                                        <input type='text' class='form-control' id='url4' placeholder='https://'
                                            name='linkedin'
                                            value='<?php if(!empty($url_rows)){foreach($url_rows as $url){if($url['SOCIALMEDIAID']==4){echo $url['SRC'];break;}}}else{echo "https://";}?>'>
                                    </div>


                                    <div class='form-group col-md-3'>
                                        <label for='url3'>twitter (X)</label>
                                        <input type='text' class='form-control' id='url3' placeholder='https://'
                                            name='x'
                                            value='<?php if(!empty($url_rows)){foreach($url_rows as $url){if($url['SOCIALMEDIAID']==3){echo $url['SRC'];break;}}}else{echo "https://";}?>'>
                                    </div>

                                    <div class='form-group col-md-3'>
                                        <label for='url2'>Instagram</label>
                                        <input type='text' class='form-control' id='url2' placeholder='https://'
                                            name='instagram'
                                            value='<?php if(!empty($url_rows)){foreach($url_rows as $url){if($url['SOCIALMEDIAID']==1){echo $url['SRC'];break;}}}else{echo "https://";}?>'>
                                    </div>

                                </div>
                                <hr class="my-4">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="<?php echo $user['ID']; ?>">
                                            <label for="inputPassword4">Old Password</label>
                                            <input type="password" class="form-control" name="old_password"
                                                id="inputPassword5">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword5">New Password</label>
                                            <input type="password" class="form-control" name="new_password"
                                                id="inputPassword5">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword6">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password"
                                                id="inputPassword6">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2">Password requirements</p>
                                        <p class="small text-muted mb-2"> To create a new password, you have to meet all
                                            of the following requirements: </p>
                                        <ul class="small text-muted pl-4 mb-0">
                                            <li> Minimum 8 character </li>
                                            <li>At least one special character</li>
                                            <li>At least one number</li>
                                            <li>Can’t be the same as a previous password </li>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Change</button>
                            </form>

                            <?php }?>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
            <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog"
                aria-labelledby="defaultModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="list-group list-group-flush my-n3">
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-box fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Package has uploaded successfull</strong></small>
                                            <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                            <small class="badge badge-pill badge-light text-muted">1m ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-download fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Widgets are updated successfull</strong></small>
                                            <div class="my-0 text-muted small">Just create new layout Index, form, table
                                            </div>
                                            <small class="badge badge-pill badge-light text-muted">2m ago</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-inbox fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Notifications have been sent</strong></small>
                                            <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo
                                            </div>
                                            <small class="badge badge-pill badge-light text-muted">30m ago</small>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="list-group-item bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="fe fe-link fe-24"></span>
                                        </div>
                                        <div class="col">
                                            <small><strong>Link was attached to menu</strong></small>
                                            <div class="my-0 text-muted small">New layout has been attached to the menu
                                            </div>
                                            <small class="badge badge-pill badge-light text-muted">1h ago</small>
                                        </div>
                                    </div>
                                </div> <!-- / .row -->
                            </div> <!-- / .list-group -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear
                                All</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog"
                aria-labelledby="defaultModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body px-5">
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-success justify-content-center">
                                        <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Control area</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Activity</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Droplet</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Upload</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-users fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Users</p>
                                </div>
                                <div class="col-6 text-center">
                                    <div class="squircle bg-primary justify-content-center">
                                        <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                                    </div>
                                    <p>Settings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
    </script>
</body>

</html>
<?php 

    }else {
      header("Location: ../index.php");
    }
    
  ?>