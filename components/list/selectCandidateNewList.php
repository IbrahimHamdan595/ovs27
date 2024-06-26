<?php
session_start();
    
include('../../Logic/Connection.php');
$user= $_SESSION['USER'];
$name = $_POST['name'];
$color = $_POST['color'];
$bigarea = $user['BIGAREAID'];



$insert_list_query = "INSERT INTO `list`(`NAME`, `COLOR`, `BIGAREA`) VALUES ('$name', '$color', '$bigarea')";
$insert_result = mysqli_query($conn, $insert_list_query);
$list_id = mysqli_insert_id($conn);


$sql = "SELECT user.*, register.REGISTERNUM FROM user JOIN register on user.REGISTERID = register.ID"; // Change 'user' to your actual table name
$result = $conn->query($sql);


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Check Your Name</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="../../dashboard/css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../../dashboard/css/feather.css">
    <link rel="stylesheet" href="../../dashboard/css/dataTables.bootstrap4.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="../../dashboard/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="../../dashboard/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="../../dashboard/css/app-dark.css" id="darkTheme" disabled>
    <!-- <link rel="stylesheet" href="../../assets/css/style.css" /> -->

</head>

<body class="vertical  light collapsed  ">
    <div class="wrapper">

        <main role="main" class="main-content zero" style="margin-left: 0rem;">
            <div class="container-fluid zero">
                <div class="row justify-content-center zero">
                    <div class="col-12 zero">
                        <div class="check-header p-4 d-flex align-items-center" style="height: 250px">
                            <div class="h">
                                <h2 class="mb-2 page-title text-white">Select Your Election Partners</h2>
                                <p class="card-text text-white">Fill your list with the 7 election partners </p>
                            </div>
                        </div>
                        <div class="row my-4 p-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <form action="../../Logic/queries/update.php?setlist=true" method="post">
                                            <!-- table -->
                                            <input type="hidden" name="list_id" value="<?php echo $list_id; ?>">
                                            <table class="table datatables" id="dataTable-1">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Mother Name</th>
                                                        <th>Gender</th>
                                                        <th>DOB</th>
                                                        <th>Big Area</th>
                                                        <th>Small Area</th>
                                                        <th>Record</th>
                                                        <th>Register ID</th>
                                                        <th>Center ID</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php 

                                                        if ($result->num_rows > 0) {

                                                        while($row = $result->fetch_assoc()) {
                                                            $get_location_query = "SELECT smallarea.NAME AS small_area_name, bigarea.ID AS big_area_id,bigarea.NAME AS big_area_name, record.NAME AS record_name
                                                            FROM user
                                                            JOIN register ON user.REGISTERID = register.ID
                                                            JOIN record ON register.RECORDID = record.ID
                                                            JOIN smallarea ON record.SMALLAREAID = smallarea.ID
                                                            JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
                                                            WHERE user.ID =". $row['ID']; 
                                
                                                            $get_location = mysqli_query($conn, $get_location_query);
                                                            $location = mysqli_fetch_assoc($get_location);
                                
                                                            if ($row['ROLEID'] == 1 && $location['big_area_id'] == $bigarea && empty($row['LISTID']) ){
                                                                echo "
                                                                    <tr>
                                                                
                                                                    <td>
                                                                        <input style='z-index: 100' class='custom-checkbox' type='checkbox' name='selected_users[]' value='".$row['ID']."'>
                                                                    </td>
                                                                    <td>".$row['ID']."</td>
                                                                    <td>".$row['FIRSTNAME']. $row['MIDDLENAME']. $row['LASTNAME']."</td>
                                                                    <td>".$row['MOTHERNAME']."</td>";
                                                                    if ($row['GENDER'] == 1){
                                                                    echo "
                                                                        <td>Female</td>
                                                                    ";
                                                                    }else {
                                                                    echo "<td>Male</td>";
                                                                    }
                                                                    echo "
                                                                    <td>".$row['DOB']."</td>
                                                                    <td>". $location['big_area_name']."</td>
                                                                    <td>". $location['small_area_name']."</td>
                                                                    <td>". $location['record_name']."</td>
                                                                    <td>".$row['REGISTERNUM']."</td>
                                                                    <td>".$row['CENTERID']."</td>
                                                                    
                                                                </tr>";
                                                                }
                                                                }
                                                            } else {
                                                                echo "0 results";
                                                            }

                            ?>

                                                </tbody>
                                            </table>
                                            <input type="submit" value="Add to List" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- simple table -->
                        </div> <!-- end section -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
    </div>
    </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="../../dashboard/js/jquery.min.js"></script>
    <script src="../../dashboard/js/popper.min.js"></script>
    <script src="../../dashboard/js/moment.min.js"></script>
    <script src="../../dashboard/js/bootstrap.min.js"></script>
    <script src="../../dashboard/js/simplebar.min.js"></script>
    <script src='../../dashboard/js/daterangepicker.js'></script>
    <script src='../../dashboard/js/jquery.stickOnScroll.js'></script>
    <script src="../../dashboard/js/tinycolor-min.js"></script>
    <script src="../../dashboard/js/config.js"></script>
    <script src='../../dashboard/js/jquery.dataTables.min.js'></script>
    <script src='../../dashboard/js/dataTables.bootstrap4.min.js'></script>
    <script>
    $('#dataTable-1').DataTable({
        autoWidth: true,
        "lengthMenu": [
            [16, 32, 64, -1],
            [16, 32, 64, "All"]
        ]
    });
    </script>
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