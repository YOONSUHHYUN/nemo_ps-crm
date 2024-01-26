<?php
session_start(); // 세션을 시작합니다.

if (isset($_POST['selectedDate'])) {
    $_SESSION['selectedDate'] = $_POST['selectedDate'];
    echo "Session variable set successfully.";
    // 세션 변수 값 확인을 위한 로그
    error_log("Selected date: " . $_SESSION['selectedDate']);
} else {
    echo "No selected date provided.";
}
?>