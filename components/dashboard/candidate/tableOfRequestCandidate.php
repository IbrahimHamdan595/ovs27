<h2>Candidate Management Requests</h2>
<div class="card shadow">
    <div class="card-body">
        <!-- table -->
        <table class="table datatables" id="dataTable-1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Big Area</th>
                    <th>Small Area</th>
                    <th>Family Id</th>
                    <th>Account Statement</th>
                    <th>Justice Record</th>
                    <th>Exam</th>
                    <th>Paid</th>
                    <th>Accepted</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php  
                  while($nom_request = mysqli_fetch_assoc($get_nom_request)) {
                    if($nom_request['ACCEPTED']==0){
                      $get_user_details_query = "SELECT DOB, FIRSTNAME, LASTNAME, MIDDLENAME, smallarea.NAME AS small_area_name, bigarea.NAME AS big_area_name, record.NAME AS record_name
                      FROM user
                      JOIN register ON user.REGISTERID = register.ID
                      JOIN record ON register.RECORDID = record.ID
                      JOIN smallarea ON record.SMALLAREAID = smallarea.ID
                      JOIN bigarea ON smallarea.BIGAREAID = bigarea.ID
                      WHERE user.ID =". $nom_request['USERID']; 
                      $get_user_details = mysqli_query($conn, $get_user_details_query);
                      $user_details = mysqli_fetch_assoc($get_user_details);
                ?>
                <tr>
                    <td><?php echo $nom_request['USERID']; ?></td>
                    <td><?php echo $user_details['FIRSTNAME']  .$user_details['MIDDLENAME'] .$user_details['LASTNAME']; ?>
                    </td>
                    <td><?php echo $user_details['DOB'];?></td>
                    <td><?php echo $user_details['big_area_name']?></td>
                    <td><?php echo $user_details['small_area_name']?></td>
                    <td><?php echo "<a href='../uploads/".$nom_request['FAMILYID']."'>family id</a>"; ?></td>
                    <td><?php echo "<a href='../uploads/".$nom_request['ACCOUNTSTATMENT']."'>account</a>"; ?></td>
                    <td><?php echo "<a href='../uploads/".$nom_request['JUSTICERECORD']."'>justice</a>"; ?></td>
                    <td>
                        <?php
                          if ($nom_request['EXAM']) {
                            echo " <span class='text-secondary'>Do It</span> ";                             
                          }else {
                            echo "
                              <a class='btn btn-secondary' href='../Logic/queries/update.php?exam=".$nom_request['ID']."'>Finished</a>
                            ";
                          }
                        ?>
                    </td>
                    <td>
                        <?php
                          if ($nom_request['ISPAID']) {
                            echo " <span style='green'>Paid</span> "; 
                          }else {
                            echo"
                              <a class='btn btn-secondary' href='../Logic/queries/update.php?paid=".$nom_request['ID']."'>Paid</a>
                            ";
                          }
                        ?>
                    </td>
                    <td>
                        <?php
                          if ($nom_request['ACCEPTED']) {
                            echo " <span style='green'>Accepted</span> ";
                          }else {
                            echo"
                              <a class='btn btn-secondary' href='../Logic/queries/update.php?accepted=".$nom_request['ID']."&userId=".$nom_request['USERID']."'>Accept</a>
                              <a class='btn btn-danger' href='../Logic/queries/delete.php?c_rejects=".$nom_request['ID']."'>Reject</a>
                            ";
                          }
                        ?>
                    </td>
                </tr>
                <?php }
                  }?>
            </tbody>
        </table>
    </div>
</div>