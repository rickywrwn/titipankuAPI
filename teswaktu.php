<?php
$cdValue = 3600.0;
date_default_timezone_set("Asia/Jakarta");
$date = new DateTime("2018-08-31 07:56:16");
$date2 =  new DateTime();
// $diff = $now->diff($ref);
// printf('%d days, %d hours, %d minutes, %d seconds', $diff->d, $diff->h, $diff->i,  $diff->s);
$diffSeconds = $date->getTimestamp() - $date2->getTimestamp();
echo $diffSeconds;
 ?>
