<script>
function loadXMLDoc1(dlistID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("listvotes").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "listvotes.php?dlistID=" + dlistID, true);
    xhttp.send();
}

function loadXMLDoc2(userID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("candidatevotes").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "candidatevotes.php?userID=" + userID, true);
    xhttp.send();
}

window.onload = function() {
    var dlistID = <?php echo $dlist['ID']; ?>; // Make sure this is the correct ID for the dlist
    var userID = <?php echo $rowlist['ID']; ?>; // Make sure this is the correct ID for the user

    loadXMLDoc1(dlistID);
    loadXMLDoc2(userID);
    setInterval(function() {
        loadXMLDoc1(dlistID);
    }, 500);
    setInterval(function() {
        loadXMLDoc2(userID);
    }, 500);
};
</script>

<?php

if ($dlist['BIGAREA'] == $blist['ID'] ) {
echo "
<div class='card list-card d-flex flex-column m-2' style='background:".$dlist['COLOR'].";width: 300px'>
    <div class='pt-4'>
        <h3 class='d-flex flex-row justify-content-around'>
            <b class='text-white'> ".$dlist['NAME']." </b>
            <div class='d-flex align-items-center p-2 ml-1 bg-light' id='listvotes' style='height: 30px;'>".$dlist['VOTESNUM']."</div> 
       </h3>
       <hr>
    </div>";

while($rowlist = mysqli_fetch_assoc($get_list_users)) {
    echo "
    <div class='d-flex flex-row p-4 align-items-end'>
        <img class='' src='".$rowlist['PROFILE']."'/>
        <div class='d-flex align-items-center px-1 ml-1 flex-grow-1 bg-light' style='height: 50px;'>".$rowlist['FIRSTNAME']." ".$rowlist['MIDDLENAME']." ".$rowlist['LASTNAME']."</div>
        <div class='d-flex align-items-center px-2 ml-1 bg-light' id='candidatevotes' style='height: 50px;'>".$rowlist['VOTENUMBER']."</div> 
    </div>";
}

echo "</div>";

}
?>

<script>
window.onload = function() {
    var dlistID = <?php echo $dlist['ID']; ?>; // Assuming $dlist['ID'] is available
    var userID = <?php echo $rowlist['ID']; ?>; // Assuming $rowlist['ID'] is available

    loadXMLDoc1(dlistID);
    loadXMLDoc2(userID);
    setInterval(function() {
        loadXMLDoc1(dlistID);
    }, 500);
    setInterval(function() {
        loadXMLDoc2(userID);
    }, 500);
};
</script>