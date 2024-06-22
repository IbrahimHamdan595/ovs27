<?php

    include "../Logic/queries/select.php";
    
    $celebration = mysqli_fetch_assoc($get_celebration);
    $specifiedDateTime = new DateTime($celebration['ENDINGDATE']);
    $currentDateTime = new DateTime();


    // BEFORE : DISPLAY STARTING PROCESS - DISABLE VERIFY
    // IN: ENABLE VERIFY - NOTHING DISPLAYED
    // AFTER: DISPLAY SHOW RESULT - SHOW RESULT

    if (!$celebration['STARTDATE']) {
  
?>

<div class="col-md-12">
    <div class="card shadow eq-card mb-4">
        <div class="card-body mb-n3">
            <div class="row items-align-baseline h-100">
                <div class="col-md-6 my-3 d-flex flex-row justify-content-around">
                    <p>Let's start with voting</p>
                    <a class="btn btn-danger" href="../Logic/query/update.php?start=true">Start</a>
                </div>
            </div> <!-- .card-body -->
        </div> <!-- .card -->
    </div>

    <?php  } else if($currentDateTime > $specifiedDateTime){ ?>
    <div class="col-md-12">
        <div class="card shadow eq-card mb-4">
            <div class="card-body mb-n3">
                <div class="row items-align-baseline h-100">
                    <div class="col-md-6 my-3 d-flex flex-row justify-content-around">
                        <p>Let's View results</p>
                        <a class="btn btn-danger" href="../Logic/query/update.php?end=true">Result</a>
                    </div>
                </div> <!-- .card-body -->
            </div> <!-- .card -->
        </div>
        <?php }
            else if($celebration['ENDINGDATE'] && !$celebration['ENDED'])
            {
                echo "<span></span>";

}
   ?>