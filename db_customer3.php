<?php

$update = mysqli_query($conn,"INSERT INTO company_info(num,연장여부,이탈사유,연장예상)
VALUES ('".$_GET['num']."','".$_GET['status']."','".$_GET['expreason']."','".$_GET['exp2']."') ON DUPLICATE KEY UPDATE num='".$_GET['num']."',연장여부='".$_GET['status']."',이탈사유='".$_GET['expreason']."',연장예상='".$_GET['exp2']."'");

$update2 = mysqli_query($conn,"INSERT INTO all_info(해당월,담당자,cost)
VALUES ( '".$_GET['date2']."','".$_GET['name2']."','".$_GET['cost']."') ON DUPLICATE KEY UPDATE 담당자='".$_GET['name2']."',해당월='".$_GET['date2']."',cost='".$_GET['cost']."' ");



#23/1/2 original
#$update = mysqli_query($conn,"INSERT INTO company_info(num,연장여부,이탈사유)
#VALUES ('".$_GET['num']."','".$_GET['status']."','".$_GET['expreason']."') ON DUPLICATE KEY UPDATE num='".$_GET['num']."',연장여부='".$_GET['status']."',이탈사유='".$_GET['expreason']."'");

#9/6 original
#$update = mysqli_query($conn,"INSERT INTO company_info(num,연장여부)
#VALUES ('".$_GET['num']."','".$_GET['status']."') ON DUPLICATE KEY UPDATE num='".$_GET['num']."',연장여부='".$_GET['status']."'");


?>
