<h2>Congratulations, Candidate</h2>
<div class="card shadow">
    <div class="card-body">
        <!-- table -->
        <table class="table datatables" id="dataTable-1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Big Area</th>
                    <th>Small Area</th>
                    <th>List Name</th>
                    <th>Number Of Votes</th>
                </tr>
            </thead>
            <tbody>

                <?php  
                           
                           $get_location_query = "
                            SELECT user.ID AS user_id, user.FIRSTNAME, user.LASTNAME, user.MIDDLENAME, smallarea.NAME AS small_area_name, list.NAME AS list_name, electionprogram.PROFILE, bigarea.NAME AS big_area_name, box.VOTENUMBER AS vote_number
                            FROM result
                            JOIN user ON user.ID = result.user_id
                            JOIN electionprogram ON electionprogram.USERID = user.ID 
                            JOIN smallarea ON smallarea.ID = result.small_area_id JOIN list ON list.ID = result.list_id
                            JOIN bigarea ON bigarea.ID = smallarea.BIGAREAID JOIN box ON box.USERID = user.ID
                           "; 

                           $get_location = mysqli_query($conn, $get_location_query);
                           while($row = mysqli_fetch_assoc($get_location)) {
                              
                            ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php 
                    if(isset($_GET['res'])){
                        echo "<img class='' src='../".$row['PROFILE']."'/></td>";
                    }else{
                        echo "<img class='' src='".$row['PROFILE']."'/></td>";
                    }?>
                    <td><?php echo $row['FIRSTNAME'] ." " .$row['MIDDLENAME'] ." " .$row['LASTNAME']; ?></td>
                    <td><?php echo $row['big_area_name']?></td>
                    <td><?php echo $row['small_area_name']?></td>
                    <td><?php echo $row['list_name'] ?></td>
                    <td><?php echo $row['vote_number'];?></td>

                    <?php 
                               }?>

            </tbody>
        </table>
    </div>
</div>
<?php if(isset($_GET['res'])){?>
<script src="../dashboard/js/jquery.min.js"></script>
<script src="../dashboard/js/popper.min.js"></script>
<script src="../dashboard/js/moment.min.js"></script>
<script src="../dashboard/js/bootstrap.min.js"></script>
<script src="../dashboard/js/simplebar.min.js"></script>
<script src='../dashboard/js/daterangepicker.js'></script>
<script src='../dashboard/js/jquery.stickOnScroll.js'></script>
<script src="../dashboard/js/tinycolor-min.js"></script>
<script src="../dashboard/js/config.js"></script>
<script src='../dashboard/js/jquery.dataTables.min.js'></script>
<script src='../dashboard/js/dataTables.bootstrap4.min.js'></script>
<?php }else{?>
<script src="./dashboard/js/jquery.min.js"></script>
<script src="./dashboard/js/popper.min.js"></script>
<script src="./dashboard/js/moment.min.js"></script>
<script src="./dashboard/js/bootstrap.min.js"></script>
<script src="./dashboard/js/simplebar.min.js"></script>
<script src='./dashboard/js/daterangepicker.js'></script>
<script src='./dashboard/js/jquery.stickOnScroll.js'></script>
<script src="./dashboard/js/tinycolor-min.js"></script>
<script src="./dashboard/js/config.js"></script>
<script src='./dashboard/js/jquery.dataTables.min.js'></script>
<script src='./dashboard/js/dataTables.bootstrap4.min.js'></script>
<?php } ?>
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