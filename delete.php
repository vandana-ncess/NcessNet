<?php 
    $conn = require_once('databaseconnection.php');
    $id = $_GET['id'];
    $table = $_GET['table'];
    switch ($table) {
    case 'privileges':
        $sql = "UPDATE adminmenu_privileges SET status=0 WHERE privilegeID=" . $id;
        break;
    case 'topics':
        $sql = "UPDATE discussion_topics SET status=0 WHERE topicsID=" . $id;
        break;
    default:
        break;
}
$result = mysqli_query($conn,$sql);
if($result)
    echo 'Deleted Successfully!';
else 
    echo 'Failed to delete!';
?>