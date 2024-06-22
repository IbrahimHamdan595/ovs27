<?php

    $get_all_big_area_query = "SELECT * from bigarea";
    $get_all_big_area =  mysqli_query($conn, $get_all_big_area_query);

    $voted= array();
    $not_voted = array();
    
    while($big_area = mysqli_fetch_assoc($get_all_big_area)){

        $get_votes_query= "SELECT bigarea.ID as big_area_id, bigarea.NAME AS big_area_name, COUNT(user.ID) as voters FROM user 
        JOIN register ON user.REGISTERID = register.ID 
        JOIN record ON register.RECORDID = record.ID 
        JOIN smallarea ON record.SMALLAREAID = smallarea.ID 
        JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
        WHERE bigarea.ID =".$big_area['ID']." and user.VOTED = 1 and user.ROLEID <> 2";
        
        $get_votes =  mysqli_query($conn, $get_votes_query);
        $votes = mysqli_fetch_assoc($get_votes);
        $voted[] =$votes['voters'];

        $get_not_votes_query= "SELECT bigarea.ID as big_area_id, bigarea.NAME AS big_area_name, COUNT(user.ID) as voters FROM user 
        JOIN register ON user.REGISTERID = register.ID 
        JOIN record ON register.RECORDID = record.ID 
        JOIN smallarea ON record.SMALLAREAID = smallarea.ID 
        JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
        WHERE bigarea.ID =".$big_area['ID']." and user.VOTED = 0 and user.ROLEID <> 2";
        
        $get_not_votes=  mysqli_query($conn, $get_not_votes_query);
        $not_votes = mysqli_fetch_assoc($get_not_votes);
        $not_voted[] =$not_votes['voters'];
    }
    



   
?>

<div class="col-md-12 col-lg-4">
    <div class="card shadow eq-card mb-4">
        <div class="card-body">
            <div class="d-flex mt-3 mb-4">
                <div class="flex-fill chart-box mt-n2">
                    <div style="width: 100%" id="bo"></div>
                </div>
            </div> <!-- .d-flex -->
        </div>
        <!-- .card-body -->
    </div> <!-- .card -->
</div> <!-- .col-md -->
</div> <!-- .row -->

<?php 
echo  "
<script>
var options = {
    series: [{
        name: 'Voted',
        data: [".$voted[0].", ".$voted[1].", ".$voted[2]."]
    }, {
        name: 'Not Voted',
        data: [".$not_voted[0].", ".$not_voted[1].", ".$not_voted[2]."]
    }],
    chart: {
        type: 'bar',
        height: 350,
        stacked: true,
    },
    plotOptions: {
        bar: {
            horizontal: true,
            dataLabels: {
                total: {
                    enabled: true,
                    offsetX: 0,
                    style: {
                        fontSize: '13px',
                        fontWeight: 900
                    }
                }
            }
        },
    },
    stroke: {
        width: 1,
        colors: ['#fff']
    },
    title: {
        text: 'Voting analycis'
    },
    xaxis: {
        categories: ['North', 'Beirut', 'South'],
        labels: {
            formatter: function(val) {
                return val + ''
            }
        }
    },
    yaxis: {
        title: {
            text: undefined
        },
    },
    tooltip: {
        y: {
            formatter: function(val) {
                return val + ''
            }
        }
    },
    fill: {
        opacity: 1
    },
    legend: {
        position: 'top',
        horizontalAlign: 'left',
        offsetX: 40
    }
};

var chart = new ApexCharts(document.querySelector('#bo'), options);
chart.render();

</script>
";

?>