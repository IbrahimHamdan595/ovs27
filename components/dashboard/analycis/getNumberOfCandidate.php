<?php
    $get_total_query = "SELECT count(ID)as total from user where ROLEID = 1";
    $get_total =  mysqli_query($conn, $get_total_query);
    $total = mysqli_fetch_assoc($get_total);

    $bigarea = "1";
    if (isset($_GET['big_area'])) {
        $bigarea = $_GET['big_area'];
    }
    
?>

<div class="col-md-12 col-lg-4">
    <div class="card shadow eq-card mb-4">
        <div class="card-body mb-n3">
            <div class="row items-align-baseline h-100">
                <div class="col-md-6 my-3">
                    <?php

                        if (isset($_GET['big_area'])) {
                            $get_small_area_query = "SELECT ID from smallarea where BIGAREAID =".$bigarea;
                            $get_small_area =  mysqli_query($conn, $get_small_area_query);
                         
                        }else {
                            $get_small_area_query = "SELECT ID from smallarea where BIGAREAID =1";
                            $get_small_area =  mysqli_query($conn, $get_small_area_query);
                            
                        }
                        
                        
                            
                            $get_big_Area_query = "SELECT bigarea.ID as big_area_id, bigarea.NAME AS big_area_name, COUNT(user.ID) as candidates
                            FROM user
                            JOIN register ON user.REGISTERID = register.ID
                            JOIN record ON register.RECORDID = record.ID
                            JOIN smallarea ON record.SMALLAREAID = smallarea.ID
                            JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
                            WHERE bigarea.ID =".$bigarea."  and user.ROLEID = 1";
                            $get_big_area =  mysqli_query($conn, $get_big_Area_query);
                            $big_area_details = mysqli_fetch_assoc($get_big_area);

                            $percentage = $big_area_details['candidates'] * 100 / $total['total'];
                            $percentage = number_format($percentage, 2);

                                
                        
                        


                    ?>
                    <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">Big Area Candidates </strong></p>
                    <form method='get' action='' class='mb-4 mt-2'>
                        <select class="form-select" name='big_area' aria-label="Default select example">
                            <option value="1">North</option>
                            <option value="2">Beirut</option>
                            <option value="3">South</option>
                        </select>
                        <button class='btn btn-secondary px-1' type="submit">Submit</button>
                    </form>
                    <h3>
                        <?php 
                          
                                echo $big_area_details['candidates']." candidates";
                            
                    ?></h3>
                </div>

                <div class="col-md-6 my-4 text-center">
                    <div lass="chart-box mx-4">
                        <div id="radial" style="width: 100%; "></div>
                    </div>
                </div>
                <?php
                    while ($small_area = mysqli_fetch_assoc($get_small_area)){

                        $get_small_area_candidates_query="SELECT smallarea.ID, smallarea.NAME, COUNT(user.ID) as candidates
                        FROM user
                        JOIN register ON user.REGISTERID = register.ID
                        JOIN record ON register.RECORDID = record.ID
                        JOIN smallarea ON record.SMALLAREAID = smallarea.ID
                        WHERE smallarea.ID =".$small_area['ID']."  and user.ROLEID = 1";

                        $small_area_candidates =  mysqli_query($conn, $get_small_area_candidates_query);
                        $small_area_details = mysqli_fetch_assoc($small_area_candidates);

                        if (isset($small_area)) {
                        $s_percentage = $small_area_details['candidates'] * 100 / $big_area_details['candidates'];
                        $s_percentage = number_format($s_percentage, 2);

                        echo "
                            <div class='col-md-3 border-top py-3'>
                                <p class='mb-1 px-0'><strong class='text-muted'>".$small_area_details['NAME']."</strong></p>
                                <h4 class='mb-0'>".$small_area_details['candidates']."</h4>
                                <p class='small text-muted mb-0'><span>".$s_percentage."</span></p>
                            </div> <!-- .col -->
                        ";
                    }
                }
                ?>


            </div>
        </div> <!-- .card-body -->
    </div> <!-- .card -->
</div>

<?php 
    echo "
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <script>
        var options = {
            series: [".$percentage."],
            chart: {
                height: 200,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '68%',
                    }
                },
            },
            labels: ['".$big_area_details['big_area_name']."'],
        };

        var chart = new ApexCharts(document.getElementById('radial'), options);
        chart.render();
    </script>
    ";

?>