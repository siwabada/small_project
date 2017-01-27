<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>정말 삭제하시겠습니까?</p>
    <a href="/process.php?mode=delete&id=<?=$_GET['id']?>">예</a>
    <a href="/index.php?id=<?=$_GET['id']?>">취소</a>
  </body>
</html>
