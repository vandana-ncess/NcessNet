<?php 
    $catID = $_GET['catID'];
    if($catID > 0)
        $str = " AND categoryID=" . $catID;
    $conn  = require_once('databaseconnection.php');
    $sql = "SELECT designationID,designation FROM designation WHERE designationStatus=1" . $str; 
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0) {
        echo '<select id="ddlDesignation" name="ddlDesignation" style="width: 250px;"><option value=0>All</option>';
        while($data = mysqli_fetch_array($result)){
            echo '<option value=' . $data['designationID'] . '>' . $data['designation'] . '</option>' ;
        }
        echo '</select>';
    }
?>