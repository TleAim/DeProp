<?php
function diffDate($creationDate) {
    $currentDate = new DateTime();
    $checkDate = date_create($creationDate);

    $diff=date_diff($currentDate,$checkDate);
    $diffDate = $diff->format("%a");
    return $diffDate;
}

?>