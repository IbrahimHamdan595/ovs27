<?php
  session_start();
  include("../Logic/Connection.php");
  include "../Logic/queries/select.php";

  $user = $_SESSION["USER"];

  $get_program_sql = "SELECT * FROM electionprogram where electionprogram.USERID =". $user['ID'];
  $get_program = mysqli_query($conn, $get_program_sql);
  $program =  mysqli_fetch_assoc($get_program);

  $celebration = mysqli_fetch_assoc($get_celebration);
  
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
    :root {
        --arrow-bg: rgba(0, 0, 0, 0.3);
        --arrow-icon: url(https://upload.wikimedia.org/wikipedia/commons/9/9d/Caret_down_font_awesome_whitevariation.svg);
        --option-bg: rgba(0, 0, 0, 0.3);
        --select-bg: rgba(0, 0, 0, 0.2);
    }

    select {
        /* Reset */
        appearance: none;
        border: 0;
        outline: 0;
        font: inherit;
        /* Personalize */
        width: 7.5rem;
        padding: 0.5rem 4rem 0.5rem 1rem;
        background: var(--arrow-icon) no-repeat right 0.8em center / 1.4em,
            linear-gradient(to left, var(--arrow-bg) 3em, var(--select-bg) 3em);
        color: white;
        border-radius: 0.25em;
        /* box-shadow: 0 0 1em 0 rgba(0, 0, 0, 0.2); */
        cursor: pointer;

        /* Remove IE arrow */
        &::-ms-expand {
            display: none;
        }

        /* Remove focus outline */
        &:focus {
            outline: none;
        }

        /* <option> colors */
        option {
            color: inherit;
            background-color: var(--option-bg);
        }
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
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="row items-align-baseline">
                            <div class="col-md-12 pt-4 mt-4">
                                <?php if($user['ROLEID'] == 1 && !empty($user['LISTID'])) {
                                    echo "<h2>My Votes</h2>";
                                    // include "../components/dashboard/monitor/singleCandidateMonitor.php";
                                    echo "<div id='singleCandidateMonitor'></div>";
                            }?>
                                <h2>List Monitor</h2>
                                <?php
                                    while ($blist = mysqli_fetch_assoc($get_big_area)) {
                                        echo "<h6 class='pt-4'>".$blist['NAME']."</h6>";
                                        echo "<div class='d-flex flex-row flex-wrap '> ";
                                        
                                        mysqli_data_seek($get_list, 0);
                                            while($dlist = mysqli_fetch_assoc($get_list)) {
                                                if ($dlist['ACCEPTED'] == 1){
                                                    $get_list_users_query = "SELECT *, user.ID as ID
                                                    FROM user
                                                    JOIN electionprogram ON user.ID = electionprogram.USERID
                                                    JOIn box ON box.USERID = user.ID
                                                    JOIN register ON user.REGISTERID = register.ID
                                                    JOIN record ON register.RECORDID = record.ID
                                                    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
                                                    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
                                                    JOIN list on list.ID = user.LISTID
                                                    WHERE user.LISTID =". $dlist['ID']. "
                                                    ORDER BY smallarea.priority ASC, bigarea.NAME ASC";
                                                    $get_list_users =  mysqli_query($conn,$get_list_users_query);
                                                    
                                                    include "../components/dashboard/monitor/allListMonitor.php";

                                                    // echo "<div id='allListMonitor'></div>";
                                                }
                                                    }
                                        echo "</div>";
                                    }


            ?>
                            </div>

                        </div>
                    </div> <!-- .row-->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script>
    function loadXMLDoc1() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("singleCandidateMonitor").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "../components/dashboard/monitor/singleCandidateMonitor.php", true);
        xhttp.send();
    }



    window.onload = function() {
        loadXMLDoc1();
        setInterval(loadXMLDoc1, 500);
    };
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/apps.js"></script>

</body>

</html>

<?php

    }else {
      header("Location: ../index.php");
    }?>