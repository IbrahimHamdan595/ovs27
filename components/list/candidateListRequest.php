<form method="POST" action="../components/list/selectCandidateNewList.php" class="card p-4" style="max-width: 100%;">

    <div class='d-flex flex-row d-flex justify-content-center'>
        <!-- <div class="form-group px-2" style='width: 45%'>
                <label for="bigarea">Big Area:</label>
                <select id="bigarea" name="bigarea" class="form-control">
                    <?php
                    while ($bigarea = mysqli_fetch_assoc($bigarea_result)) {
                        echo "
                            <option value='".$bigarea['ID']."'>
                                ".$bigarea['NAME']."
                            </option>
                        ";
                    }
                    ?>
                </select>
            </div> -->
        <div class="form-group px-2" style='width: 45%'>
            <!-- <la    bel for="candidate">Candidate:</la>
                <select id="candidate" name="candidate" class="form-control">
                    <?php
                    // Populate options for candidates
                    ?>
                    <option value="">Select a candidate</option>
                </select> -->
        </div>
    </div>
    <div class='d-flex flex-row d-flex justify-content-center' style='width: 100%'>
        <div class="form-group px-2" style='width: 45%'>
            <label for="name">Name:</label>
            <input type="text" placeholder='Enter the list name' id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group px-2" style='width: 45%'>
            <label for="color">Color:</label>
            <input type="color" id="color" name="color" class="form-control" required>
        </div>
    </div>


    <div class='mt-2 d-flex justify-content-center' style='width: 100%'>
        <?php
      
      if (!empty($user['LISTID'])&& !empty($dlist)) {
          echo "
          <button type='submit'  disabled class='btn btn-danger' style='width: 30%'>Submit</button>
          ";
        }else {
            echo "
            <button type='submit' class='btn btn-danger' style='width: 30%'>Submit</button>
      ";
      }
    
    ?>
    </div>
</form>