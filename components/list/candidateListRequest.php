<form method="POST" action="../components/list/selectCandidateNewList.php" class="card p-4" style="max-width: 100%;">
    <div class='d-flex flex-row d-flex justify-content-center'>
        <?php
            while ($bigarea = mysqli_fetch_assoc($bigarea_result)) {
                echo "
                    <option value='".$bigarea['ID']."'>
                        ".$bigarea['NAME']."
                    </option>
                    ";
                }
        ?>
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
            } else {
                echo "
                    <button type='submit' class='btn btn-danger' style='width: 30%'>Submit</button>
                    ";
            }
        ?>
    </div>
</form>