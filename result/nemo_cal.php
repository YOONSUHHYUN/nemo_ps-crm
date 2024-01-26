<?php
$startingdate = $_GET['startingdate'];
$number = 10;#$_GET['number']; 
$address = $_GET['address'];
$newdiscount = 0.2;
$option = $_GET['option'];
#echo htmlspecialchars($startingdate);
#echo htmlspecialchars($number);
#echo htmlspecialchars($newdiscount);
#echo htmlspecialchars($option);



#기준금액
$cp = "SELECT (SELECT 가격 FROM product_nomal WHERE 시 = '".$_GET['address1']."' and 구 = '".$address."' limit 1 )/10 * '".$number."' as cp";
$result2 = mysqli_query($conn,$cp) or die(mysqli_error($conn));
$row2 = mysqli_fetch_assoc($result2);
#echo htmlspecialchars($row2['cp']);



#시작월 일할계산
$sdprice = "SELECT TRUNCATE('".$row2['cp']."' / date_format(last_day('".$startingdate."'),'%d'),0) as sdprice";
$result3 = mysqli_query($conn,$sdprice) or die(mysqli_error($conn));
$row3 = mysqli_fetch_assoc($result3);
#echo htmlspecialchars($row3['sdprice']);

#시작월 사용일수
$startdays = "SELECT DATE_FORMAT(last_day('".$startingdate."'),'%d') - DATE_FORMAT('".$startingdate."','%d')+1 as startdays";
$result4 = mysqli_query($conn,$startdays) or die(mysqli_error($conn));
$row4 = mysqli_fetch_assoc($result4);
#echo htmlspecialchars($row4['startdays']);

#시작월 마지막일
$startmonthdays = "SELECT DATE_FORMAT(last_day('".$startingdate."'),'%d') as startmonthdays";
$result5 = mysqli_query($conn,$startmonthdays) or die(mysqli_error($conn));
$row5 = mysqli_fetch_assoc($result5);
#echo htmlspecialchars($row5['startmonthdays']);

#1달 더하기
$nextmonth = "SELECT DATE_ADD('".$startingdate."', INTERVAL 1 MONTH) as nextmonth";
$result6 = mysqli_query($conn,$nextmonth) or die(mysqli_error($conn));
$row6 = mysqli_fetch_assoc($result6);
#echo htmlspecialchars($row6['nextmonth']);

#1달후 마지막일
$nextmonthdays = "SELECT date_format(last_day('".$row6['nextmonth']."'),'%d') as nextmonthdays";
$result7 = mysqli_query($conn,$nextmonthdays) or die(mysqli_error($conn));
$row7 = mysqli_fetch_assoc($result7);
#echo htmlspecialchars($row7['nextmonthdays']);

#종료일
$enddate =
"SELECT CASE
WHEN (SELECT DATE_FORMAT('".$startingdate."','%d')) < 6
THEN (SELECT last_day('".$startingdate."'))
ELSE (SELECT last_day('".$row6['nextmonth']."'))
end as enddate";
$result11 = mysqli_query($conn,$enddate) or die(mysqli_error($conn));
$row11 = mysqli_fetch_assoc($result11);
#echo htmlspecialchars($row11['enddate']);





#사용일수
$usedays = "SELECT CASE
WHEN (SELECT DATE_FORMAT('".$startingdate."','%d')) < 6
THEN
 (SELECT DATE_FORMAT(last_day('".$startingdate."'),'%d') - DATE_FORMAT('".$startingdate."','%d'))
ELSE
 (SELECT DATE_FORMAT(last_day('".$startingdate."'),'%d') - DATE_FORMAT('".$startingdate."','%d')) + (SELECT date_format(last_day(DATE_ADD('".$startingdate."', INTERVAL 1 MONTH)),'%d'))
END as usedays";
$result8 = mysqli_query($conn,$usedays) or die(mysqli_error($conn));
$row8 = mysqli_fetch_assoc($result8);
#echo htmlspecialchars($row8['usedays']);


#할인율 적용전
$nonedis = "SELECT CASE
WHEN
	(SELECT DATE_FORMAT('".$startingdate."','%d')) < 6
THEN
	(SELECT ('".$row4['startdays']."'* '".$row3['sdprice']."'))
ELSE
	(SELECT ('".$row4['startdays']."' *'".$row3['sdprice']."') + '".$row2['cp']."')
end as nonedis";
$result9 = mysqli_query($conn,$nonedis) or die(mysqli_error($conn));
$row9 = mysqli_fetch_assoc($result9);
#echo htmlspecialchars($row9['nonedis']);


$firstmonth = "SELECT ('".$row4['startdays']."'* '".$row3['sdprice']."') as firstmonth";
$result12 = mysqli_query($conn,$firstmonth) or die(mysqli_error($conn));
$row12 = mysqli_fetch_assoc($result12);
#echo htmlspecialchars($row12['firstmonth']);

#신규,복귀 일반금액
$newnormalprice = "SELECT TRUNCATE('".$row9['nonedis']."' * (1 - '".$newdiscount."'),-1) as newnormalprice";
$result10 = mysqli_query($conn,$newnormalprice) or die(mysqli_error($conn));
$row10 = mysqli_fetch_assoc($result10);
#echo htmlspecialchars($row10['newnormalprice']);



$memo1 = "SELECT CASE
WHEN
	(SELECT DATE_FORMAT('".$startingdate."','%d')) < 6
THEN
	'분류: 1~5일 / 1개월 결제건'
ELSE
	'분류: 6일이후 / 1개월 결제건'
end as memo1";
$result13 = mysqli_query($conn,$memo1) or die(mysqli_error($conn));
$row13 = mysqli_fetch_assoc($result13);
#echo htmlspecialchars($row13['memo1']);




 ?>
