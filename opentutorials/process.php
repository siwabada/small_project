<?php
require('config/config.php');
require('lib/db.php');
$conn = db_init($config['host'],$config['duser'],$config['dpw'],$config['dname']);

  switch($_GET['mode']){
      case 'insert':
          $desc = str_replace(' ','&nbsp;',addslashes($_POST['description']));
          // addslashes(); 함수를 사용하여 '', "" - 싱글/더블 쿼테이션 입력시 오류 수정 // str_replace(' ', '&nbsp;', '타겟'); 함수를 통해서 멀티플 스페이스 대응
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
        $desc = str_replace(' ','&nbsp;',addslashes($_POST['description']));
          $sql = "UPDATE topic SET title = '".htmlspecialchars(addslashes($_POST['title']))."', description = '".$desc."', author = '".$_POST['author']."' WHERE id = '".$_GET['id']."'";
          $result = mysqli_query($conn, $sql);
          header("Location: /index.php?id={$_GET['id']}");
          break;
  }
?>
