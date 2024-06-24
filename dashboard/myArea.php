<?php
  session_start();
  include "../Logic/Connection.php";
  include "../Logic/queries/select.php";

  $celebration = mysqli_fetch_assoc($get_celebration);

  $user = $_SESSION["USER"];
  
  if ($user) {
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/favicon.png">
    <title>OVS - dashboard</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/select2.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/uppy.min.css">
    <link rel="stylesheet" href="css/jquery.steps.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <style>
    .pagination a {
        margin: 0 5px;
        padding: 8px 16px;
        text-decoration: none;
        color: #6c757d;
    }

    .pagination a.active {
        background-color: #dc3545;
        color: white;
        border: 1px solid #dc3545;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
    </style>
</head>

<body class="vertical  light collapsed  ">
    <div class="wrapper">

        <!-- navbar -->
        <?php include "../components/dashboard/navigation/dashboardNavBar.php"; ?>
        <!-- side bar -->
        <?php include "../components/dashboard/navigation/dashboardSideBar.php"; ?>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <h2 class="mb-2 page-title">Check your area voters</h2>
                <p class="card-text"> Use this page to quickly find out your area voters informations
                    Simply enter his/her name in the search bar below and hit enter to see if it matches any entries on
                    the list.
                </p>
                <div class="row my-4 p-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- Filter Form -->
                                <form method="GET" action="myArea.php" class="mb-4">
                                    <small>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12"></line>
                                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        </svg>
                                        Filtering by any of this details
                                    </small>

                                    <div class="input-group class=" mb-2">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search for names or other details..."
                                            value="<?php echo htmlspecialchars($search); ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- table -->
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
                                            <th>Center</th>
                                            <th>Voted</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                    if ($result->num_rows > 0) {
                                                        while($row = mysqli_fetch_assoc($result)) {
                                                            echo "
                                                                <tr>
                                                                    <td>
                                                                        <div class='custom-control custom-checkbox'>
                                                                            <input type='checkbox' class='custom-control-input'>
                                                                            <label class='custom-control-label'></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>".$row['ID']."</td>
                                                                    <td>".$row['FIRSTNAME']." ". $row['MIDDLENAME']." ". $row['LASTNAME']."</td>
                                                                    <td>".$row['MOTHERNAME']."</td>";
                                                                    if ($row['GENDER'] == 1){
                                                                        echo "<td>Female</td>";
                                                                    } else {
                                                                        echo "<td>Male</td>";
                                                                    }
                                                                    echo "
                                                                    <td>".$row['DOB']."</td>
                                                                    <td>". $row['big_area_name']."</td>
                                                                    <td>". $row['small_area_name']."</td>
                                                                    <td>". $row['record_name']."</td>
                                                                    <td>".$row['REGISTERNUM']."</td>
                                                                    <td>".$row['center_name']."</td>  
                                                                    <td>
                                                                    ";
                                                                    if ($row['VOTED']) {
                                                                        echo "<span style='color: green'>voted</span>";
                                                                    }else {
                                                                        echo "<span style='color: red'>Not yet</span>";
                                                                    }
                                                                    echo "
                                                                    </td>
                                                                </tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='11'>No results found</td></tr>";
                                                    }
                                                ?>
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    <?php
                                        // Define the range of page numbers to be shown
                                        $range = 2; // Number of page links to show on either side of the current page

                                        // Previous link
                                        if ($page > 1) {
                                            echo '<a href="myArea.php?page=' . ($page - 1) . '&search=' . urlencode($search) . '">&laquo; Previous</a>';
                                        }

                                        // First page link
                                        if ($page > $range + 1) {
                                            echo '<a href="myArea.php?page=1&search=' . urlencode($search) . '">1</a>';
                                            if ($page > $range + 2) {
                                                echo '<span>...</span>'; // Ellipsis for skipped pages
                                            }
                                        }

                                        // Page number links within the defined range
                                        for ($page_num = max(1, $page - $range); $page_num <= min($total_pages, $page + $range); $page_num++) {
                                            if ($page == $page_num) {
                                                echo '<a href="myArea.php?page=' . $page_num . '&search=' . urlencode($search) . '" class="active">' . $page_num . '</a>';
                                            } else {
                                                echo '<a href="myArea.php?page=' . $page_num . '&search=' . urlencode($search) . '">' . $page_num . '</a>';
                                            }
                                        }

                                        // Last page link
                                        if ($page < $total_pages - $range) {
                                            if ($page < $total_pages - $range - 1) {
                                                echo '<span>...</span>'; // Ellipsis for skipped pages
                                            }
                                            echo '<a href="myArea.php?page=' . $total_pages . '&search=' . urlencode($search) . '">' . $total_pages . '</a>';
                                        }

                                        // Next link
                                        if ($page < $total_pages) {
                                            echo '<a href="myArea.php?page=' . ($page + 1) . '&search=' . urlencode($search) . '">Next &raquo;</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div>
    </div>
    </div>
    </div>
    </main>
    <script src="../dashboard/js/bootstrap.min.js"></script>
    <script src="../dashboard/js/simplebar.min.js"></script>
    <script src='../dashboard/js/dataTables.bootstrap4.min.js'></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
</body>

</html>

<?php 

    }else {
      header("Location: ../voter/index.php");
    }?>