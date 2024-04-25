<?php

$update3 = mysqli_query($conn,
"INSERT INTO target(업체명,대표자명,연락처,시도,시군구) VALUES ('".$_GET['company']."','".$_GET['owner']."','".$_GET['phonenum']."','".$_GET['address1']."','".$_GET['address2']."')");




?>