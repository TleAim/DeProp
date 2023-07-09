<!DOCTYPE html>
<html>
<body>


<?php



$date1 = date_create("2023-07-1");
$date2 = new DateTime();
$diff=date_diff($date1,$date2);
$diffDate = $diff->format("%a");

echo "Check : ".$diffDate;

if($diffDate > 10){
    echo "More than 10";
}else{
    echo "Less than 10";
}

?>

</body>
</html>
