<?php
    $get_total_query = "SELECT count(ID)as total from user where ROLEID <>2";
    $get_total =  mysqli_query($conn, $get_total_query);
    $total = mysqli_fetch_assoc($get_total);

    $get_all_small_area_query = "SELECT * from smallarea";
    $get_all_small_area =  mysqli_query($conn, $get_all_small_area_query);
    
    $votes = array();
  
?>

<div class="col-md-12 col-lg-12">
    <div class="card shadow eq-card mb-4">
        <div class="card-body">
            <div class="chart-widget mb-2">
                <div id="graph" style="width: 100%; "></div>
            </div>
            <div class="row items-align-center">
                <?php 
                while ($smallarea = mysqli_fetch_assoc($get_all_small_area)) {

                    $get_voters_query= "SELECT COUNT(user.ID) as voters
                    FROM user
                    JOIN register ON user.REGISTERID = register.ID
                    JOIN record ON register.RECORDID = record.ID
                    JOIN smallarea ON record.SMALLAREAID = smallarea.ID
                    JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
                    WHERE smallarea.ID = ".$smallarea['ID']." and user.VOTED =1
                    ";
                    $get_voters =  mysqli_query($conn, $get_voters_query);
                    $voters = mysqli_fetch_assoc($get_voters);

                    $votes[]= $voters['voters'];
                   
                }
                ?>
            </div>
        </div> <!-- .card-body -->
    </div> <!-- .card -->
</div> <!-- .col -->
<?php echo "
<script>
var options = {
    series: [{
        name: 'Votes',
        data: [".$votes[0].", ".$votes[1].", ".$votes[2].", ".$votes[3].", ".$votes[4].",
            ".$votes[5].", ".$votes[6].", ".$votes[7].", ".$votes[8]."
        ]
    }],
    chart: {
        height: 350,
        type: 'bar',
    },
    plotOptions: {
        bar: {
            borderRadius: 10,
            dataLabels: {
                position: 'top', // top, center, bottom
            },
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function(val) {
            return val + '';
        },
        offsetY: -20,
        style: {
            fontSize: '12px',
            colors: ['#094806']
        }
    },

    xaxis: {
        categories: ['TRIPOLI', 'AKKAR', 'MENYE', 'DENNIYE', 'BEIRUT', 'SAIDA', 'SOUR', 'JEZZINE', 'B-JBEIL', ],
        position: 'top',
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        crosshairs: {
            fill: {
                type: 'gradient',
                gradient: {
                    colorFrom: '#D8E3F0',
                    colorTo: '#BED1E6',
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                }
            }
        },
        tooltip: {
            enabled: true,
        }
    },
    yaxis: {
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: false,
            formatter: function(val) {
                return val + '';
            }
        }

    },
    title: {
        text: 'NUMBER OF VOTERS PER SMALL AREA, 2024',
        floating: true,
        offsetY: 330,
        align: 'center',
        style: {
            color: '#094806'
        }
    }
};

var chart = new ApexCharts(document.querySelector('#graph'), options);
chart.render();
</script>

"; ?>