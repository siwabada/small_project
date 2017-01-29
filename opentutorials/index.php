<?php
  require('config/config.php');
  require('lib/db.php');
  $conn = db_init($config['host'],$config['duser'],$config['dpw'],$config['dname']);
  // DB 서버($conn)에서 조회할 테이블 (topic)의 모든 정보를 가져온다. 결과값을 $result 변수에 저장
  $result = mysqli_query($conn, 'SELECT * FROM topic order by id desc');
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>몽키와선샤인</title>
  <link rel="icon" href="favicon.png">
  <link href="/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/style.css">
  <script type="text/javascript">
    function del_confirm(){
      var result = confirm('정말로 삭제 하시겠습니까?');
      if(result === true){
        alert('삭제완료')
        location.replace("/process.php?mode=delete&id=<?=$_GET['id']?>");
      }else{
        location.replace("/index.php?id=<?=$_GET['id']?>");
      }
    }
  </script>
</head>
<body>
  <div class="container col-md-8 col-lg-offset-2">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation" class="active"><a href="/write.php">글쓰기</a></li>
        </ul>
      </nav>
      <h3 class="text-muted"><a href="/index.php"><img src="/favicon.png" alt="로고" class="logo"><span class="title">몽키와 썬샤인의 영어공부</span></a></h3>
    </div>
    <hr class="header_line">
    <?php
      if(empty($_GET['id']) === true){
    ?>
      <div class="table-responsive">
        <table class="table table-striped text-center table-bordered">
          <tr class="active">
            <td width="5%">#</td>
            <td width="50%">제목</td>
            <td width="10%">작성자</td>
            <td width="15%">날짜</td>
          </tr>
          <?php
            $i = 1;
            while($row = mysqli_fetch_assoc($result)){
          ?>
            <tr>
              <td width="5%"><?= $i?></td>
              <td width="50%"><a href="/index.php?id=<?=$row['id']?>"><?=$row['title']?></a></td>
              <td width="10%"><?= $row['author']?></td>
              <td width="15%"><?= $row['created']?></td>
            </tr>
          <?php $i = $i + 1; }?>
        </table>
      </div>
    <?}?>
    <?php
      if(empty($_GET['id']) === false){
        $sql = 'SELECT id, title, description, author FROM topic WHERE id = "'.$_GET['id'].'"';
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
      ?>
      <div class="panel panel-default">
        <div class="panel-heading"><strong><?=$row['title']?></strong><br>by <?=$row['author']?></div>
        <div class="panel-body">
          <?=nl2br($row['description'])?>
        </div>
      </div>
        <a href="/modify.php?id=<?=$row['id']?>" class="btn btn-warning">수정</a>
        <!-- <a href="/delete.php?id=<?=$row['id']?>" class="btn btn-danger">삭제</a> -->
        <a onclick="del_confirm()" class="btn btn-danger">삭제</a>

    <?}?>
    </div>
  </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
</body>
</html>
