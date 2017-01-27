<?php
  $conn = mysqli_connect('localhost', 'siwabada', 'wakame12');
  mysqli_query($conn, 'set names utf8');
  mysqli_select_db($conn, 'siwabada');

  switch($_GET['mode']){
      case 'insert':
          $desc = addslashes($_POST['description']); // addslashes(); 함수를 사용하여 '', "" - 싱글/더블 쿼테이션 입력시 오류 수정
          $sql ="INSERT INTO topic (title,description,author,created) VALUES('".htmlspecialchars(addslashes($_POST['title']))."', '".$desc."', '".$_POST['author']."', now())";
          $result = mysqli_query($conn, $sql);
          header('Location: /index.php');
          break;
      case 'delete':
          $sql = "DELETE FROM topic WHERE id ='".$_GET['id']."'";
          mysqli_query($conn, $sql);
          header("Location: /index.php");
          break;
      case 'modify':
          $desc = addslashes($_POST['description']);
          $sql = "UPDATE topic SET title = '".htmlspecialchars(addslashes($_POST['title']))."', description = '".$desc."', author = '".$_POST['author']."' WHERE id = '".$_GET['id']."'";
          $result = mysqli_query($conn, $sql);
          header("Location: /index.php?id={$_GET['id']}");
          break;
  }
?>
