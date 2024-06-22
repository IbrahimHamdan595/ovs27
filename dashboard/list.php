<?php
  session_start();
  include "../Logic/connection.php";
  include("../Logic/queries/select.php");
  
  $user = $_SESSION["USER"];
  
  $get_program_sql = "SELECT * FROM electionprogram where electionprogram.USERID =". $user['ID'];
  $get_program = mysqli_query($conn, $get_program_sql);
  $program =  mysqli_fetch_assoc($get_program);

  if (!empty($user['LISTID']) ){            
    $my_list_query = "SELECT list.* FROM user JOIN list ON list.ID = user.LISTID WHERE LISTID =".$user['LISTID']." AND user.ID =". $user['ID']; 
    $get_my_list =  mysqli_query($conn,$my_list_query);
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
</head>

<body class="vertical  light collapsed  ">
    <div class="wrapper">

        <!-- navbar -->
        <?php include "../components/dashboard/navigation/dashboardNavBar.php"; ?>
        <!-- side bar -->
        <?php include "../components/dashboard/navigation/dashboardSideBar.php"; ?>

        <main role="main" class="main-content">
            <div class="col-md-12">
                <?php 
                    if ($user['ROLEID'] == 1 && !empty($user['LISTID'])) {
                        $dlist = mysqli_fetch_assoc($get_my_list);
                        if (!empty($user['LISTID']) && !empty($dlist)){
                            echo "
                                <h2>My List</h2>
                                <br>
                                <div class=' d-flex flex-row justify-content-center'>";
                            if ($dlist['ACCEPTED'] == 1){
                                include "../components/list/listOfACandidate.php";
                            }
                            echo "</div>";
                        }
                    }
                    echo "<br><br>";
                ?>
                <?php 
                    if ($user['ROLEID'] == 2) {
                        echo "<h2>List Management</h2>";
                        include '../components/list/mangmentOfList.php';
                    }
                 
                    if ($user['ROLEID'] == 1) {
                        echo "
                            <h2>Apply for a New List</h2>
                            <p>You can now apply to create a new list. You can't select a user that have a list!</p>
                            ";
                        include '../components/list/candidateListRequest.php';
                    }                  
                ?>
            </div>
            <div class="col-md-12 pt-4 mt-4">
                <h2>All lists</h2>
                <?php
                    mysqli_data_seek($get_list, 0);
                            
                    while ($blist = mysqli_fetch_assoc($get_big_area)) {                       
                        echo "<h6 class='pt-4'>".$blist['NAME']."</h6>";
                        echo "<div class='d-flex flex-row flex-wrap '>";
                        mysqli_data_seek($get_list, 0);
                        
                        while($dlist = mysqli_fetch_assoc($get_list)) {
                            if ($dlist['ACCEPTED'] == 1 ){
                                include "../components/list/showAllList.php";
                            }
                        } 
                        echo "</div>";
                    }
            ?>
            </div>
        </main>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/simplebar.min.js"></script>
        <script src='js/daterangepicker.js'></script>
        <script src='js/jquery.stickOnScroll.js'></script>
        <script src="js/tinycolor-min.js"></script>
        <script src="js/config.js"></script>
        <script src="js/d3.min.js"></script>
        <script src="js/topojson.min.js"></script>
        <script src="js/datamaps.all.min.js"></script>
        <script src="js/datamaps-zoomto.js"></script>
        <script src="js/datamaps.custom.js"></script>
        <script src="js/Chart.min.js"></script>
        <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
        </script>
        <script src="js/gauge.min.js"></script>
        <script src="js/jquery.sparkline.min.js"></script>
        <script src="js/apexcharts.min.js"></script>
        <script src="js/apexcharts.custom.js"></script>
        <script src='js/jquery.mask.min.js'></script>
        <script src='js/select2.min.js'></script>
        <script src='js/jquery.steps.min.js'></script>
        <script src='js/jquery.validate.min.js'></script>
        <script src='js/jquery.timepicker.js'></script>
        <script src='js/dropzone.min.js'></script>
        <script src='js/uppy.min.js'></script>
        <script src='js/quill.min.js'></script>
        <script>
        $('.select2').select2({
            theme: 'bootstrap4',
        });
        $('.select2-multi').select2({
            multiple: true,
            theme: 'bootstrap4',
        });
        $('.drgpicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        });
        $('.time-input').timepicker({
            'scrollDefault': 'now',
            'zindex': '9999' /* fix modal open */
        });
        /** date range picker */
        if ($('.datetimes').length) {
            $('.datetimes').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });
        }
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                    .endOf('month')
                ]
            }
        }, cb);
        cb(start, end);
        $('.input-placeholder').mask("00/00/0000", {
            placeholder: "__/__/____"
        });
        $('.input-zip').mask('00000-000', {
            placeholder: "____-___"
        });
        $('.input-money').mask("#.##0,00", {
            reverse: true
        });
        $('.input-phoneus').mask('(000) 000-0000');
        $('.input-mixed').mask('AAA 000-S0S');
        $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
            translation: {
                'Z': {
                    pattern: /[0-9]/,
                    optional: true
                }
            },
            placeholder: "___.___.___.___"
        });
        // editor
        var editor = document.getElementById('editor');
        if (editor) {
            var toolbarOptions = [
                [{
                    'font': []
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                        'header': 1
                    },
                    {
                        'header': 2
                    }
                ],
                [{
                        'list': 'ordered'
                    },
                    {
                        'list': 'bullet'
                    }
                ],
                [{
                        'script': 'sub'
                    },
                    {
                        'script': 'super'
                    }
                ],
                [{
                        'indent': '-1'
                    },
                    {
                        'indent': '+1'
                    }
                ], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction
                [{
                        'color': []
                    },
                    {
                        'background': []
                    }
                ], // dropdown with defaults from theme
                [{
                    'align': []
                }],
                ['clean'] // remove formatting button
            ];
            var quill = new Quill(editor, {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        </script>
        <script>
        var uptarg = document.getElementById('drag-drop-area');
        if (uptarg) {
            var uppy = Uppy.Core().use(Uppy.Dashboard, {
                inline: true,
                target: uptarg,
                proudlyDisplayPoweredByUppy: false,
                theme: 'dark',
                width: 770,
                height: 210,
                plugins: ['Webcam']
            }).use(Uppy.Tus, {
                endpoint: 'https://master.tus.io/files/'
            });
            uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful)
            });
        }
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

<?php 
    }else {
      header("Location: ../index.php");
    }
?>