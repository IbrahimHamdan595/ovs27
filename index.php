<?php

    include "./Logic/connection.php";
    include "./logic/queries/select.php";

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
    <link rel="icon" href="./assets/img/favicon.png" sizes="20x20" type="image/png" />
    <!-- animate -->
    <link rel="stylesheet" href="./assets/css/animate.css" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <!-- magnific popup -->
    <link rel="stylesheet" href="./assets/css/magnific-popup.css" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css" />
    <!-- iconmoon -->
    <link rel="stylesheet" href="./assets/css/iconmoon.css">
    <!-- Hover CSS -->
    <link rel="stylesheet" href="./assets/css/hover-min.css" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="./assets/css/style.css" />
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="./assets/css/responsive.css" />
    <!-- Link to bootsrap Icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLongTitle">Welcome</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="./Logic/auth/login.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Card ID </label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="userId" required
                                aria-describedby="emailHelp" placeholder="Enter the card id">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                required placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">LogIn</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vote poll start here -->

    <div class="poll-wrapper">
        <header>
            <div class="thumb">
                <img src="./assets/img/poll-img.png" alt="">
            </div>
            <div class="content">
                <h6 class="voter-name">Lebanon Votes! </h6>
                <span>ENTER TO THE ELECTION</span>
            </div>
            <button class="poll-btn close-btn"><i class="fas fa-times"></i></button>
        </header>
        <form method="post" action="./Logic/auth/login.php?process=true">
            <div class="form-group">
                <label for="exampleInputEmail1">Card ID </label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="userId" required
                    aria-describedby="emailHelp" placeholder="Enter the card id">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">First Name</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="fname" required
                    placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Last Name</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="lname" required
                    placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required
                    placeholder="Password">
            </div>

            <?php
                $celebration = mysqli_fetch_assoc($get_celebration);
            ?>

            <div class="btn-wrapper vote-btn">
                <?php if($celebration['STARTDATE']) { 
                echo "<button type='submit' class='boxed-btn btn-sanatory'>
                    Verify
                    <i class='fas fa-vote-yea'></i>
                </button>";
            }else{
                echo "<button type='submit' class='boxed-btn btn-sanatory ' disabled>
                Verify
                <i class='fas fa-vote-yea'></i>
            </button> ";  
            }
                ?>
            </div>
        </form>
    </div>
    <div class="btn-wrapper poll-btn">
        <span class="boxed-btn btn-poll">
            Vote Now
            <i class="fas fa-vote-yea"></i>
        </span>
    </div>
    <!-- Vote poll start here -->
    <div class="header-style-01">
        <!-- support bar area end -->
        <nav class="navbar navbar-area style-01 navbar-expand-lg nav-style-02">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <div class="logo-wrapper" style="margin-left: -70px;">
                        <a href="index.html" class="logo">
                            <img src="./assets/img/logo.png" width="800px" alt="" />
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                    <ul class="navbar-nav political">
                        <li class="menu-item-has-children ">
                            <a href="#">Home</a>

                            <div class="line">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot style-02"></span>
                            </div>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#about">About</a>

                            <div class="line">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot style-02"></span>
                            </div>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#list">Check Name</a>
                            <div class="line">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot style-02"></span>
                            </div>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#programs">Programs</a>
                            <div class="line">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot style-02"></span>
                            </div>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#lists">Lists</a>
                            <div class="line style-01">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot style-02"></span>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="nav-right-content style-01">
                    <div class="btn-wrapper">
                        <a href="#" class="boxed-btn political-btn" data-toggle="modal"
                            data-target="#exampleModalCenter">LogIn<i class="bi bi-box-arrow-in-right"></i></a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar area end -->
    </div>
    <div class="header-area header-sanatory header-bg-02"
        style="background-image:url(./assets/img/d9986bebe6e8971143a56a99a67f374f.jpg);">
        <div class="header-side-content">
            <ul class="top-single-items">
                <li class="top-single-item">
                    <div class="side-icon">
                        <i class="icon-phone"></i>
                    </div>
                    <div class="content">
                        <h5 class="title">+961-1 778090</h5>
                    </div>
                </li>
                <li class="top-single-item">
                    <div class="side-icon">
                        <i class="icon-envelope"></i>
                    </div>
                    <div class="content">
                        <h5 class="title">info@ovs.lb</h5>
                    </div>
                </li>
            </ul>
        </div>
        <div class="container nav-container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="header-inner political">
                        <!-- header inner -->
                        <div class="subtitle">
                            <span>since 1947</span>
                            <span class="line"></span>
                            <span class="line-02"></span>
                        </div>
                        <h1 class="title">Empowering Every Voice, Shaping Our Future: Lebanon Votes! </h1>

                        <form>
                            <div id="mycountdown" class="counter-single-item style-01">
                                <ul>
                                    <li class="counter-item wow animate__animated animate__fadeInUp animate__delay-1s">
                                        <span class="month"></span>
                                        <h6>Month</h6>
                                    </li>
                                    <li class="counter-item wow animate__animated animate__fadeInUp">
                                        <span class="days"></span>
                                        <h6>Days</h6>
                                    </li>
                                    <li class="counter-item wow animate__animated animate__fadeInUp animate__delay-1s">
                                        <span class="hours"></span>
                                        <h6>Hours</h6>
                                    </li>
                                    <!--<li class="counter-item wow animate__animated animate__fadeInUp animate__delay-2s">
                          <span class="mins"></span>
                          <h6>Minuts</h6>
                        </li>
                        <li class="counter-item wow animate__animated animate__fadeInUp animate__delay-2s">
                          <span class="secs"></span>
                          <h6>Second</h6>
                        </li>-->
                                </ul>
                            </div>
                        </form>
                    </div>
                    <!-- //.header inner -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header section End -->


    <!-- Header bottom Section Start -->
    <div class="header-bottom-area margin-top-120">
        <div class="container">
            <div class="political-header-bottom m-top-02" id="about">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="our-vision-item wow animate__animated animate__fadeInLeft">
                            <div class="vision-bg" style="background-image: url(./assets/img/Group\ 4.png);">
                                <div class="content">
                                    <div class="subtitle">
                                        <p>Lebanese Election</p>
                                        <div class="icon">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </div>
                                    </div>
                                    <h4 class="title">Together We Are Stronger</h4>
                                    <div class="btn-wrapper">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="vision-single-item-wrapper">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="our-vision-single-item  wow animate__animated animate__fadeInUp">
                                        <div class="icon">
                                            <i class="icon-winner-cup"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Lebanon Votes, Democracy Thrives</h4>
                                            <p>Encourages active participation in the electoral process to strengthen
                                                democratic principles and institutions.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div
                                        class="our-vision-single-item style-01 wow animate__animated animate__fadeInRight">
                                        <div class="icon">
                                            <i class="icon-love-4223"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Informed Choices, Empowered Citizens</h4>
                                            <p> Advocates for voter education and awareness to enable citizens to make
                                                informed decisions that align with their values.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div
                                        class="our-vision-single-item style-02 wow animate__animated animate__fadeInUp animate__delay-1s">
                                        <div class="icon">
                                            <i class="icon-tree"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Fair Elections, Brighter Tomorrow</h4>
                                            <p>Promotes the importance of free and fair elections as a catalyst for
                                                positive change and a promising future.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div
                                        class="our-vision-single-item wow animate__animated animate__fadeInRight animate__delay-1s">
                                        <div class="icon">
                                            <i class="icon-target-3696"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">From Polls to Progress, Lebanon Moves Forward</h4>
                                            <p>Highlights the transformative impact of electoral participation in
                                                driving national progress and advancement.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header bottom section end -->

    <!-- Our Vision party section start -->
    <div class="our-party-section-area party-vision">
        <div class="party-bg vision-bg" style="background-image: url(./assets/img/CatchyBusinessNameChecklist.jpg)">
        </div>
        <img src="./assets/img/line-shape.png" class="party-vision-shape" alt="">
        <div class="container" id="list">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="party-single-item vision">
                        <div class="content">
                            <div class="subtitle wow animate__animated animate__fadeInUp">
                                <p>Check your Name</p>
                                <div class="icon">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                            </div>
                            <h4 class="title wow animate__animated animate__fadeInUp">Verify Your Voice, Check Your
                                Name: Be Heard in the Vote!</h4>
                            <p class="description wow animate__animated animate__fadeInUp">
                                In a democracy, every citizen's voice matters, and ensuring your name is on the voting
                                list is the first step to exercising your democratic.
                            </p>
                            <p class="description none wow animate__animated animate__fadeInUp">
                                By verifying their names on the voting list, citizens contribute to the integrity and
                                inclusivity of elections, fostering a more representative and responsive government.
                            </p>
                            <div class="vision-quotes wow animate__animated animate__fadeInRight animate__delay-1s">
                                <h5 class="title">Successfully Providing the Best Solution from 77 years</h5>
                                <div class="icon">
                                    <img src="./assets/icon/quotes-02.svg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-wrapper margin-top-35 wow animate__animated animate__fadeInUp">
                            <a href="./components/checkName.php" class="boxed-btn btn-sanatory style-022"><i
                                    class="fas fa-arrow-right"></i>Check your Name</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our vision party section end -->

    <!-- Join our party section start -->
    <div class="join-party-section-area join-bg" style="background-image: url(./assets/img/Group\ 5.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="join-single-item">

                        <div class="content" id="candidate">
                            <div class="subtitle wow animate__animated animate__fadeInUp">
                                <p>Be a Candidate</p>
                                <div class="icon">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                            </div>
                            <h4 class="title wow animate__animated animate__fadeInUp">Shape the Future You Envision!
                            </h4>
                            <p class="description wow animate__animated animate__fadeInUp">
                                Being a candidate in an election is about more than just running for office—it's about
                                taking an active role in shaping the future of your community or country. By stepping up
                                to be a candidate, you have the opportunity to represent the interests and concerns of
                                your fellow citizens, advocate for positive change, and contribute to the democratic
                                process
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-page-wrapper wow animate__animated animate__fadeInRight">
                        <div class="contact-form contact-bg" style="background-image: url(./assets/img/Group5.png);">
                            <div class="content desktop-center">
                                <img src="./assets/img/circle-02.png" class="title-shape" alt="">
                                <h6 class="title">Apply Now</h6>
                            </div>
                            <form action="./Logic/queries/insert.php" class="contact-page-form" novalidate="novalidate"
                                method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="ID" placeholder="User ID" class="form-control"
                                                required=aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="Record_ID" placeholder="Record ID"
                                                class="form-control" required=aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="familyID" class="form-label">Enter Your Family ID</label>
                                            <input type="file" id="familyID" name="FAMILYID" class="form-control"
                                                required=aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="accountStatement" class="form-label">Enter your Account
                                                Statement</label>
                                            <input type="file" id="accountStatement" name="ACCOUNTSTATMENT"
                                                class="form-control" required=aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="justiceRecord" class="form-label">Enter your Justice
                                                Record</label>
                                            <input type="file" id="justiceRecord" name="JUSTICERECORD"
                                                class="form-control" required=aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-wrapper desktop-center">
                                            <button type="submit" class="boxed-btn political-btn style-01">JOIN NOW<i
                                                    class="icon-paper-plan"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Join our party section end -->

    <!-- Party Member Section Start Here -->
    <div class="party-member-section-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="party-single-item party-member">
                        <div class="content">
                            <div class="subtitle wow animate__animated animate__fadeInUp">
                                <p>Meet Our Candidates</p>
                                <div class="icon">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                            </div>
                            <h4 class="title wow animate__animated animate__fadeInUp">
                                <div>
                                    Meet Our Candidates:
                                </div>
                                Your Voice, Their Vision
                            </h4>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-eight political-member">
                        <?php
              
                            // Step 3: Iterate through fetched data
                            while ($row = mysqli_fetch_assoc($get_election_program)) {

                                $get_user_query = "SELECT * FROM user WHERE ID = ".$row['USERID'];
                                $get_user = mysqli_query($conn, $get_user_query);
                                $user = mysqli_fetch_assoc($get_user);

                                
                                $get_urls_query = "SELECT * FROM url WHERE ELECTIONPROGRAMID = ".$row['ID'];
                                $get_url = mysqli_query($conn, $get_urls_query);
                                
                                
                                $urls = []; // Initialize an empty array to store fetched data
                                
                                for ($i = 0; $i < 4; $i++) {
                                $urls[$i]= mysqli_fetch_assoc($get_url);
                                }
                                
                                if($user['ROLEID'] == 1){
                                
                                    echo "
                                        <div class='single-party-member-item wow animate__animated animate__fadeInUp'>
                                            <div class='thumb'>
                                                <img src='".$row['PROFILE']."' alt='' />
                                            </div>
                                            <div class='content'>
                                                <div class='author-meta'>
                                                    <span class='author-name'>".$user['FIRSTNAME']." ". $user['LASTNAME']."</span>
                                                </div>
                                                <div class='social-links'>
                                                    <ul>
                                    ";
                                                        if (!empty($urls)){
                                
                                                            foreach ($urls as $obj) {
                                
                                                                if (!empty($obj) && $obj['SOCIALMEDIAID'] == 1) {
                                                                    echo "<li><a href='".$obj['SRC']."'><i class='fab fa-instagram'></i></a></li>";
                                                                    }
                                                                    if (!empty($obj) && $obj['SOCIALMEDIAID'] == 2) {
                                                                    echo "<li><a href='".$obj['SRC']."'><i class='fab fa-facebook-f'></i></a></li>";
                                                                    }
                                                                    if (!empty($obj) && $obj['SOCIALMEDIAID'] == 3) {
                                                                    echo "<li><a href='".$obj['SRC']."'><i class='fab fa-twitter'></i></a></li>";
                                                                    }
                                                                    if (!empty($obj) && $obj['SOCIALMEDIAID'] == 4) {
                                                                    echo "<li><a href='".$obj['SRC']."'><i class='fab fa-linkedin-in'></i></a></li>";
                                                                    }
                                                                }
                                                        }
                                                    echo "
                                                        </ul>
                                                </div>
                                            </div>
                                        </div>";
                                }

                             }
                        ?>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- Party Member Section End Here -->


    <!-- Testimonial Section-02 Start -->
    <div class="testimonial-section-area people-say testimonial-bg-02 margin-top-90"
        style="background-image: url(./assets/img/image-election-program.png);">
        <div class="shapes political-shape">
            <img src="./assets/img/shape-04.png" class="shape-01" alt="">
            <img src="./assets/img/shape-03.png" class="shape-02" alt="">
            <div class="shape-03"></div>
            <div class="shape-04"></div>
            <img src="./assets/img/line-shape.png" class="people-img-shape" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-6" id="programs">
                    <div class="testimonial-carousel-area">
                        <div class="testimonial-carousel-four">
                            <div class="people-say-single-item">
                                <h1>Candidate Promises</h1>
                            </div>
                            <?php
             
             // Step 3: Iterate through fetched data
             mysqli_data_seek($get_election_program, 0);
             while ($row = mysqli_fetch_assoc($get_election_program)) {

               $get_user_query = "SELECT * FROM user WHERE ID = ".$row['USERID'];
               $get_user = mysqli_query($conn, $get_user_query);
               $user = mysqli_fetch_assoc($get_user);

               if($user['ROLEID'] == 1) {
                 echo "
                 
              <div class='people-say-single-item'>
                  <div class='content'>
                    <div class='subtitle'>
                      <p>Candidate Promises</p>
                      <div class='icon'>
                        <i class='icon-star'></i>
                        <i class='icon-star'></i>
                        <i class='icon-star'></i>
                      </div>
                    </div>
                    <h4 class='title'>".$user['FIRSTNAME']." ". $user['LASTNAME']."</h4>
                    <a href='".$row['WEBSITE']."'>".$user['FIRSTNAME']."-".$user['LASTNAME'].".com</a>
                    <p class='description'>' ".$row['DESCRIPTION']." '</p>
                    
                  </div>
              </div>";
               }
             }
            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Secition-02 End -->

    <!-- list Section Start -->
    <div class="news-section-start" id='lists'>
        <div class="container">
            <div class="col-md-12 pt-4 mt-4 party-single-item">
                <div class="content" id="candidate">
                    <div class="subtitle wow animate__animated animate__fadeInUp d-flex flex-row">
                        <h2>The Lists</h2>
                        <div class="icon d-flex align-items-center pl-2">
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                        </div>
                    </div>
                    <h4 class="title wow animate__animated animate__fadeInUp">Choose the candidate you trust</h4>
                    <p style='width: 100%' class="description wow animate__animated animate__fadeInUp">
                        Being a candidate in an election is about more than just running for office—it's about taking an
                        active role in shaping the future of your community or country. By stepping up to be a
                        candidate, you have the opportunity to represent the interests and concerns of your fellow
                        citizens, advocate for positive change, and contribute to the democratic process
                    </p>
                </div>
                <header>
                    <link rel='stylesheet' href='./dashboard/css/app-light.css' />
                </header>
                <?php
                

                
                while ($blist = mysqli_fetch_assoc($get_big_area)) {
                    
                    echo "<h4 class='mb-0 pt-4'>".$blist['NAME']."</h4>";
                        
                    echo "
                    <div class='mt-0 d-flex flex-row justify-content-start' style='width: 50px'>
                      <hr align='left' style='width: 10px; border: 2px solid red;'/> 
                      <hr align='left' style='width: 5px; border: 2px solid red;'/> 
                      <hr align='left' style='width: 5px; border: 2px solid red;'/> 
                    </div>
                    
                    <div class='d-flex flex-row flex-wrap justify-content-around'>";
                    mysqli_data_seek($get_list, 0);
                        while($dlist = mysqli_fetch_assoc($get_list)) {
                            
                                if ($dlist['ACCEPTED'] == 1 ){
                                    include "./components/list/showAllList.php";
                                }
                            } 
                    echo "</div>";
                }


            ?>

            </div>
        </div>
    </div>

    <?php 
     

     if($celebration['ENDED']){
        ?>
    <div class="news-section-start" id='lists'>
        <div class="container">
            <div class="col-md-12 pt-4 mt-4 party-single-item" style="width: 100%;">
                <div class="content" id="candidate">
                    <div class="subtitle wow animate__animated animate__fadeInUp d-flex flex-row">
                        <h2>The Winner Candidates</h2>
                        <div class="icon d-flex align-items-center pl-2">
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                        </div>
                    </div>
                    <p style='width: 100%' class="description wow animate__animated animate__fadeInUp">
                        Congratulations on winning the election! Your victory is a testament to your dedication and
                        commitment to shaping the future of our community or country.
                        As a winner, you now have the opportunity to represent the interests and concerns of your fellow
                        citizens, advocate for positive change,
                        and make meaningful contributions to the democratic process. Your success is an inspiration to
                        us all, and we look forward to the
                        positive impact you will undoubtedly bring in your new role.
                    </p>
                </div>

                <?php
                    include "../components/analycis/resultOfElection.php";                            
                ?>

            </div>
        </div>
    </div>
    <!-- News Section End  -->
    <?php } ?>
    <!-- footer area start -->
    <footer class="footer-area"
        style="background-image: url(./assets/img/footer-bg-022.png); background-size:cover; background-repeat: no-repeat; width: 100%">
        <div class="footer-top style-02">
            <div class="container">
                <div class="footer-top-border padding-bottom-35">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-widget widget widget_subscribe political"
                                style="background-image: url(./assets/img/footer-bg.png);">
                                <div class="shape-03"></div>
                                <div class="header-content style-01">
                                    <h4 class="title style-01">Would you like to become one of our members?</h4>
                                    <div class="btn-wrapper desktop-center">
                                        <a href="#candidate" class="boxed-btn political-btn style-01">JOIN NOW<i
                                                class="fas fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget widget">
                                <div class="about_us_widget wow animate__animated animate__fadeInUp">
                                    <a href="index.html" class="footer-logo"> <img src="./assets/img/footer-logo.png"
                                            alt="footer logo"></a>
                                    <p>President represented Delaware for 36 years in the U.S. Senate before becoming
                                        the 47th Vice
                                        President of the United States.</p>
                                    <div class="social-links">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget widget widget_nav_menu wow animate__animated animate__fadeInUp">
                                <h4 class="widget-title">
                                    Explore
                                    <span class="line">
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot style-02"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </span>
                                </h4>
                                <ul class="contact_info_list style-01 margin-bottom-50">
                                    <li class="single-info-item">
                                        <div class="icon ">
                                            <i class="icon-location"></i>
                                        </div>
                                        <div class="details">
                                            Tripoli, Sahet Al Nour
                                        </div>
                                    </li>
                                    <li class="single-info-item">
                                        <div class="icon">
                                            <i class="icon-envelope"></i>
                                        </div>
                                        <div class="details">
                                            info@ovs.lb.com
                                        </div>
                                    </li>
                                    <li class="single-info-item">
                                        <div class="icon">
                                            <i class="icon-phone"></i>
                                        </div>
                                        <div class="details">
                                            +961-1 778090
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-sm-6 col-6">
                            <div class="footer-widget widget widget_nav_menu wow animate__animated animate__fadeInUp">
                                <h4 class="widget-title">
                                    Explore
                                    <span class="line">
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot style-02"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </span>
                                </h4>
                                <ul>
                                    <li><a href="#">Team</a></li>
                                    <li><a href="#">News</a></li>
                                    <li><a href="#">Election</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="footer-widget widget widget_nav_menu wow animate__animated animate__fadeInUp">
                                <h4 class="widget-title">
                                    Useful Links
                                    <span class="line">
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot style-02"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </span>
                                </h4>
                                <ul>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms and Conditions</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="footer-widget widget widget_nav_menu wow animate__animated animate__fadeInUp">
                                <h4 class="widget-title">
                                    Quick Links
                                    <span class="line">
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot style-02"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                    </span>
                                </h4>
                                <ul>
                                    <li><a href="#about">About Us</a></li>
                                    <li><a href="#list">Check List</a></li>
                                    <li><a href="#programs">Programs</a></li>
                                    <li><a href="#news">News</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="copyright-area-inner">
                                    @2024 OVS. By Ibrahim Hamdan & Sendoss Hajj
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->

    <script src="./assets/js/jquery-2.2.4.min.js"></script>
    <!-- bootstrap -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- magnific popup -->
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <!-- wow -->
    <script src="./assets/js/wow.min.js"></script>
    <!-- owl carousel -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <!-- waypoint -->
    <script src="./assets/js/waypoints.min.js"></script>
    <!-- Mail Validation -->
    <script src="./assets/js/mail-validation.js"></script>
    <!-- Contact js -->
    <script src="./assets/js/contact.js"></script>
    <!-- counterup -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <!-- countdown -->
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <!-- VanillaTilt effect -->
    <script src="./assets/js/tilt.jquery.js"></script>
    <!-- imageloaded -->
    <script src="./assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope -->
    <script src="./assets/js/isotope.pkgd.min.js"></script>
    <!-- main js -->
    <script src="./assets/js/main.js"></script>

    <script>
    $(document).ready(function() {
        $('form.contact-page-form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: './Logic/request.php',
                type: 'POST',
                data: new FormData(this), // Use FormData to properly handle file uploads
                processData: false,
                contentType: false,
                success: function(response) {
                    // Display the alert message returned from the server
                    $('body').append(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error submitting form:', error);
                    // Handle errors if needed
                }
            });
        });
    });
    </script>
</body>

</html>