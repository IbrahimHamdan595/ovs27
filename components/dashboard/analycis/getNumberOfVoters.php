<?php
    $get_total_query = "SELECT count(ID)as total from user where ROLEID <>2";
    $get_total =  mysqli_query($conn, $get_total_query);
    $total = mysqli_fetch_assoc($get_total);

    $get_all_big_area_query = "SELECT * from bigarea";
    $get_all_big_area =  mysqli_query($conn, $get_all_big_area_query);
    
    $percentages = array();
  
?>

<div class="col-md-12 col-lg-4">
    <div class="card shadow eq-card mb-4">
        <div class="card-body">
            <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">Number of voters per area </strong></p>
            <div class="chart-widget mb-2">
                <div id="radial1" style="width: 100%; "></div>
            </div>
            <div class="row items-align-center">
                <?php 
                while ($big_area = mysqli_fetch_assoc($get_all_big_area)) {

                    $get_big_Area_query = "SELECT bigarea.ID as big_area_id, bigarea.NAME AS big_area_name, COUNT(user.ID) as voters
                    FROM user
                    JOIN register ON user.REGISTERID = register.ID
                    JOIN record ON register.RECORDID = record.ID
                    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
                    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
                    WHERE bigarea.ID = ".$big_area['ID']." and user.ROLEID <> 2";
                    
                    $get_big_area =  mysqli_query($conn, $get_big_Area_query);
                    $big_area_details = mysqli_fetch_assoc($get_big_area);

                    $percentage = $big_area_details['voters'] * 100 / $total['total'];
                    $percentage = number_format($percentage, 2);

                    $percentages[] = $percentage;

                    echo "
                        <div class='col-4 text-center'>
                            <p class='text-muted mb-1'>".$big_area_details['big_area_name']."</p>
                            <h6 class='mb-1'>".$big_area_details['voters']."</h6>
                        </div>
                    ";
                }
                ?>
            </div>
        </div> <!-- .card-body -->
    </div> <!-- .card -->
</div> <!-- .col -->
<?php 
    echo "
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <script>
         var options = {
          series: [".$percentages[0].",".$percentages[1].", ".$percentages[2]."],
          chart: {
          height: 300,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            offsetY: 0,
            startAngle: 0,
            endAngle: 270,
            hollow: {
              margin: 5,
              size: '30%',
              background: 'transparent',
              image: undefined,
            },
            dataLabels: {
              name: {
                show: false,
              },
              value: {
                show: false,
              }
            },
            barLabels: {
              enabled: true,
              useSeriesColors: true,
              margin: 8,
              fontSize: '16px',
              formatter: function(seriesName, opts) {
                return seriesName + ':  ' + opts.w.globals.series[opts.seriesIndex]
              },
            },
          }
        },
        colors: ['#DD131A', '#094806', '#727777'],
        labels: ['North', 'Beirut', 'South',],
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
                show: false
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector('#radial1'), options);
        chart.render();
    </script>
    ";

?>