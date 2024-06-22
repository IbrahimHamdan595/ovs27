<?php

    include "../Logic/connection.php";
    include "../Logic/queries/select.php";

    session_start();
    $user = $_SESSION['USER'];

    if($user) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>OVS-LB</title>
    <!-- favicon -->
    <link rel="icon" href="../assets/img/favicon.png" sizes="20x20" type="image/png" />
    <!-- animate -->
    <link rel="stylesheet" href="../assets/css/animate.css" />
    <Link rel="stylesheet" href="../dashboard/css/app-light.css" />
    <!-- magnific popup -->
    <link rel="stylesheet" href="../assets/css/magnific-popup.css" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
    <!-- iconmoon -->
    <link rel="stylesheet" href="../assets/css/iconmoon.css">
    <!-- Hover CSS -->
    <link rel="stylesheet" href="../assets/css/hover-min.css" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    <!-- Link to bootsrap Icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <style>
    .display {
        display: block;
    }
    </style>
</head>

<body>
    <div style="width: 100%" class="d-flex flex-column justify-content-center p-4">
        <div class="text-center">
            <img src="../assets/img/images.png" width="200px" alt="">
            <h4 class="text-center pt-3"><?php echo $user["big_area_name"]; ?>, <?php echo $user["small_area_name"]; ?>
            </h4>
            <hr>
            <p class="text-center my-0">The voter can vote for only one list, by clicking in the radio button of the
                list</p>
            <p class="text-center my-0 py-0">and he can also vote for a single candidate in the list he choose! by
                clicking on the radio botton next to the specific candidate </p>

            <form action='../Logic/votingQueries.php' method='post'>
                <div class='mt-3'>
                    <button type="submit" class="btn btn-danger px-4">Submit</button>
                </div>
        </div>
    </div>

    <div class="px-4 mx-4">
        <?php
                mysqli_data_seek($get_list, 0);
      
                while ($blist = mysqli_fetch_assoc($get_big_area)) {
                    if ($blist['NAME'] == $user['big_area_name'] ) {
                        echo "<div class='d-flex flex-row flex-wrap justify-content-between'>";
                        mysqli_data_seek($get_list, 0);
                        while($dlist = mysqli_fetch_assoc($get_list)) {
                            if ($dlist['ACCEPTED'] == 1 ){
                                include '../components/list/votingList.php'; 
                            }
                        } 
                    echo "</div>";
                    }
                }
            ?>
        </form>
    </div>
</body>

</html>

<?php 

}else {
    header("Location: ../index.php");
}?>