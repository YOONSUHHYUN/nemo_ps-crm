<?php

$ab = "SELECT
업체명,대표자명,결제일,결제방법,금액,상세내역,사업자등록번호,중개사등록번호,
상품,상품구분,상가사무실,sdate, edate,
datediff(edate,sdate) AS 등록기간,
datediff('".$_GET['rdate']."',sdate) AS 사용일자,
datediff(LAST_DAY(sdate),sdate)+1 AS 시작월사용일수,
DATE_FORMAT(now(),\"%d\") as 종료월사용일수
FROM plist where num=".$_GET['id'];
$result = mysqli_query($conn,$ab);
$row = mysqli_fetch_assoc($result);

$address = "SELECT b.전체주소 주소 from customer b
left JOIN plist a
on a.업체아이디 = b.고유키
where a.num =".$_GET['id'];
$result15 = mysqli_query($conn,$address);
$row15 = mysqli_fetch_assoc($result15);
#echo $row15['주소'];



$abb = "SELECT *

FROM company_info where num=".$_GET['id'];
$resultb = mysqli_query($conn,$ab);
$rowb = mysqli_fetch_assoc($resultb);





 ?>
