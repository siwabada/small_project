<?php
function db_init($host, $duser, $dpw, $dname){
  $conn = mysqli_connect($host, $duser, $dpw); // 서버에 접속한다. 결과값을 변수 $conn에 저장
  mysqli_query($conn, 'set names utf8');  // 한글꺠짐 방지
  mysqli_select_db($conn, $dname);   // 서버($conn)에서 접근할 DB를 선택한다.
  return $conn;
}
?>
