<?php
$startingdate = $_GET['startingdate'];
$number = $_GET['number'];
#$address = $_GET['address'];
$address1 =
"SELECT 시 as address1 FROM customer where 중개업소명 = '".$_GET['cname']."' and 대표자명 = '".$_GET['name']."'";
$resultaddress1 = mysqli_query($conn,$address1) or die(mysqli_error($conn));
$rowaddress1 = mysqli_fetch_assoc($resultaddress1);

$address =
"SELECT 구 as address FROM customer where 중개업소명 = '".$_GET['cname']."' and 대표자명 = '".$_GET['name']."'";
$resultaddress = mysqli_query($conn,$address) or die(mysqli_error($conn));
$rowaddress = mysqli_fetch_assoc($resultaddress);

$newdiscount = 0.3;
$option = $_GET['option'];
#echo htmlspecialchars($startingdate);
#echo htmlspecialchars($number);
#echo htmlspecialchars($newdiscount);
#echo htmlspecialchars($option);



#기준금액 에러
$cp = "SELECT (SELECT B.가격 FROM customer A left join product B on A.구 = B.구 WHERE A.중개업소명 = '".$_GET['cname']."' and 대표자명 = '".$_GET['name']."' and A.시 = B.시 limit 1)/10 * '".$number."' as cp";

$result2 = mysqli_query($conn,$cp) or die(mysqli_error($conn));
$row2 = mysqli_fetch_assoc($result2);
#echo htmlspecialchars($row2['cp']);






$test = "SELECT B.edate as test
FROM customer A
left join plist B
on A.고유키 = B.업체아이디
where A.중개업소명 = '".$_GET['cname']."' and A.대표자명 = '".$_GET['name']."'
ORDER BY B.edate desc limit 1 ";
$resulttest= mysqli_query($conn,$test) or die(mysqli_error($conn));
$rowtest = mysqli_fetch_assoc($resulttest);
#echo htmlspecialchars($rowtest['test']);


$expire = "SELECT datediff('".$startingdate."','".$rowtest['test']."') as expire";
$resultexpire= mysqli_query($conn,$expire) or die(mysqli_error($conn));
$rowexpire = mysqli_fetch_assoc($resultexpire);
#echo htmlspecialchars($rowexpire['expire']);



#할인율
$adddiscount =
"SELECT CASE
WHEN
(SELECT datediff('".$startingdate."','".$rowtest['test']."')) is null then (select 0.3)
	WHEN
(SELECT datediff('".$startingdate."','".$rowtest['test']."')) < 2 then (select 0.2)
	WHEN
(SELECT datediff('".$startingdate."','".$rowtest['test']."')) > 89 then (select 0.3)
	ELSE
	(SELECT 0)
	END adddiscount ";

$resultadddiscount = mysqli_query($conn,$adddiscount) or die(mysqli_error($conn));
$rowadddiscount = mysqli_fetch_assoc($resultadddiscount);
#echo htmlspecialchars($rowadddiscount['adddiscount']);








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
#$newnormalprice = "SELECT TRUNCATE('".$row9['nonedis']."' * (1 - '".$rowadddiscount['adddiscount']."'),-1) as newnormalprice";
$newnormalprice = "SELECT truncate('".$row9['nonedis']."' * (1 - '".$rowadddiscount['adddiscount']."'),-1) as newnormalprice";
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

$memo2 = "SELECT CASE
WHEN
	(SELECT DATE_FORMAT('".$startingdate."','%d')) < 6
THEN
	']'
ELSE
	(select concat('+1개월(','".$row2['cp']."','원)]'))
end as memo2";
$result131 = mysqli_query($conn,$memo2) or die(mysqli_error($conn));
$row131 = mysqli_fetch_assoc($result131);
#echo htmlspecialchars($row13['memo1']);




 ?>
