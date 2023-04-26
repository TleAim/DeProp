<?php
include('connect2.php');
$sql = "SELECT * FROM districts WHERE amphure_id={$_GET['amphure_id']}";
$query = mysqli_query($conn2, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);
?>