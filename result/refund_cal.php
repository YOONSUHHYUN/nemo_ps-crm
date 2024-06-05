<?php


$num = $_GET['id'];


#시작일검색
$sdate = "SELECT sdate from plist where num =" . $num;
$result2 = mysqli_query($conn, $sdate);
$row2 = mysqli_fetch_assoc($result2);

#정가검색
$price = "SELECT CASE
	WHEN 상품구분 = '일반'
		THEN
		(select
			(select B.가격 `일반정가` from plist A
			inner join
			product_nomal B
			on A.지역 = B.구
			where num ='" . $num . "' and A.지역시 = B.시 limit 1 )*
			(상품-프로모션건수+서비스건수) / 10
			from plist where num ='" . $num . "' )


#7/16 UPDATE PART START
			WHEN 상품구분 = '레드프리미엄'
				THEN
				(SELECT SUM(`가격`) `레드프리미엄정가` FROM plist A
				INNER JOIN
				(SELECT B.`지역`,B.`시`, x.* FROM red_p B CROSS JOIN LATERAL (
				SELECT '상가+사무실', `상가사무실`
				union all select '상가',`상가`
				union all select '사무실',`사무실`
				) as x (상품, 가격)) NEW
				ON A.`상품` = NEW.`지역` and A.상가사무실 = NEW.상품 and A.`지역시` = NEW.`시`
				WHERE A.num='" . $num . "' )

				WHEN 상품구분 = '레드추천'
					THEN
					(SELECT SUM(`가격`) `레드추천정가` FROM plist A
					INNER JOIN
					(SELECT B.`지역`,B.`시`, x.* FROM red_good B CROSS JOIN LATERAL (
					SELECT '상가+사무실', `상가사무실`
					union all select '상가',`상가`
					union all select '사무실',`사무실`
					) as x (상품, 가격)) NEW
					ON A.`상품` = NEW.`지역` and A.상가사무실 = NEW.상품 and A.`지역시` = NEW.`시`
					WHERE A.num='" . $num . "' )

#7/16 UPDATE PART END//

		ELSE
			(SELECT `가격` `프리미엄정가` FROM plist A
			INNER JOIN
			(SELECT B.`지역`,B.`시`, x.* FROM product_premium B CROSS JOIN LATERAL (
			SELECT '상가+사무실', `상가사무실`
			union all select '상가',`상가`
			union all select '사무실',`사무실`
			) as x (상품, 가격)) NEW
			ON A.`상품` = NEW.`지역` and A.상가사무실 = NEW.상품 and A.`지역시` = NEW.`시`
			WHERE A.num='" . $num . "' limit 1)
		END AS `정가`
					FROM plist
					WHERE num ='" . $num . "'";
$result3 = mysqli_query($conn, $price) or die(mysqli_error($conn));
$row3 = mysqli_fetch_assoc($result3);
#echo $row3['정가'];

#시작월 사용일수
$s = "SELECT datediff(LAST_DAY( '" . $row['sdate'] . "' ), '" . $row['sdate'] . "' )+1 s from plist where num=" . $num;
$result4 = mysqli_query($conn, $s) or die(mysqli_error($conn));
$row4 = mysqli_fetch_assoc($result4);
#echo $row4['s'];

#환불월 사용일수
$e = "SELECT CASE
WHEN
	DATE_FORMAT('" . $row['sdate'] . "','%m') = DATE_FORMAT('" . $_GET['rdate'] . "','%m')
then
	DATE_FORMAT('" . $_GET['rdate'] . "','%d') - DATE_FORMAT('" . $row['sdate'] . "','%d')
else
	DATE_FORMAT('" . $_GET['rdate'] . "','%d')-1
end e
from plist where num=" . $num;
$result5 = mysqli_query($conn, $e) or die(mysqli_error($conn));
$row5 = mysqli_fetch_assoc($result5);
#echo $row5['e'];

$startday = "SELECT date_format(last_day('" . $row['sdate'] . "'),'%d') startday from plist where num=" . $num;
$result12 = mysqli_query($conn, $startday) or die(mysqli_error($conn));
$row12 = mysqli_fetch_assoc($result12);
#echo $row12['startday'];


#환불월 마지막일
$lastday = "SELECT date_format(last_day('" . $_GET['rdate'] . "'),'%d') lastday ";
$result6 = mysqli_query($conn, $lastday) or die(mysqli_error($conn));
$row6 = mysqli_fetch_assoc($result6);
#echo $row6['lastday']; #pass


#시작월 일할계산
$smp = "SELECT TRUNCATE ('" . $row3['정가'] . "' / '" . $row12['startday'] . "',0) as smp";
$result7 = mysqli_query($conn, $smp) or die(mysqli_error($conn));
$row7 = mysqli_fetch_assoc($result7);
#echo $row7['smp']; #pass

# 환불월 일할계산
$lmp = "SELECT TRUNCATE ('" . $row3['정가'] . "' / '" . $row6['lastday'] . "',0) as lmp";
$result8 = mysqli_query($conn, $lmp) or die(mysqli_error($conn));
$row8 = mysqli_fetch_assoc($result8);
#echo $row8['lmp']; #pass


#월 정산개월
$middleM = "SELECT CASE
		WHEN
			DATE_FORMAT('" . $row['sdate'] . "','%m') = DATE_FORMAT('" . $_GET['rdate'] . "','%m')
		THEN
		 '0'
		ELSE
			DATE_FORMAT('" . $_GET['rdate'] . "','%m') - DATE_FORMAT('" . $row['sdate'] . "','%m')-1
		END middleM";
$result9 = mysqli_query($conn, $middleM) or die(mysqli_error($conn));
$row9 = mysqli_fetch_assoc($result9);
#echo $row9['middleM']; #pass

$deduction = "SELECT CASE -- 공제금액
	WHEN
		DATE_FORMAT('" . $row['sdate'] . "','%m') = DATE_FORMAT('" . $_GET['rdate'] . "','%m')
	THEN
		(SELECT CASE
				WHEN
					('" . $row5['e'] . "') < 8
				THEN
					('" . $row5['e'] . "' * '" . $row8['lmp'] . "')
				ELSE
					('" . $row['금액'] . "' /10) + ('" . $row5['e'] . "' * '" . $row8['lmp'] . "')
				END)
	ELSE
		('" . $row['금액'] . "' /10) + ('" . $row4['s'] . "' * '" . $row7['smp'] . "') + ('" . $row5['e'] . "' * '" . $row8['lmp'] . "') + ('" . $row3['정가'] . "'* '" . $row9['middleM'] . "')
	END as deduction";
$result10 = mysqli_query($conn, $deduction) or die(mysqli_error($conn));
$row10 = mysqli_fetch_assoc($result10);
#echo $row10['deduction'];
#echo $row['사용일자'];






$repund = "SELECT ('" . $row['금액'] . "') - ('" . $row10['deduction'] . "') repund";  # 환불금액
$result11 = mysqli_query($conn, $repund) or die(mysqli_error($conn));
$row11 = mysqli_fetch_assoc($result11);
#echo $row11['repund'];
#echo $row['금액'];
#echo $row['금액'] - $row10['deduction'];




$product = "SELECT CASE
when
(SELECT `상품구분` from plist where num='" . $_GET['id'] . "') = '일반'
THEN '일반'
else
 ' '
end product
FROM plist where num=" . $_GET['id'];
$resultproduct = mysqli_query($conn, $product); #or die(mysqli_error($conn));
$rowproduct = mysqli_fetch_assoc($resultproduct);
#echo $rowproduct['product'];

$product2 = "SELECT CASE
when
(SELECT `상품구분` from plist where num='" . $_GET['id'] . "') = '일반'
THEN '건'
else ' '
end product2
FROM plist where num=" . $_GET['id'];
$resultproduct2 = mysqli_query($conn, $product2); #or die(mysqli_error($conn));
$rowproduct2 = mysqli_fetch_assoc($resultproduct2);
#echo $rowproduct2['product2'];



?>