<?php

  date_default_timezone_set("Asia/Jakarta");
$adate=date("Y-m-d H:i:s ");
$duration=36000;
$dateinsec=strtotime($adate);
$newdate=$dateinsec+$duration;
echo date('Y-m-d H:i:s a',$newdate);
 ?>
