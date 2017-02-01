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
</head>
<body>
  <div class="container col-md-8 col-lg-offset-2">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation" class="active"><a href="/write.php">write</a></li>
        </ul>
      </nav>
      <h3 class="text-muted"><a href="/index.php"><img src="/favicon.png" alt="로고" class="logo"><span class="title">몽키와 썬샤인의 영어공부</span></a></h3>
    </div>
    <hr class="header_line">
    <form action="process.php?mode=insert" method="post">
      <div class="form-group">
       <label for="title">title</label>
       <input type="text" class="form-control" id="title" name="title" placeholder="제목" required>
     </div>
       <div class="form-group">
         <label for="author">author</label>
         <select class="form-control" id="author" name="author">
          <option>몽키</option>
          <option>썬샤인</option>
        </select>
      </div>
      <div class="form-group">
        <label for="description">description</label>
        <textarea class="form-control" rows="10" id="description" name="description"></textarea>
      </div>
      <div class="row modify-buttons">
      <input type="submit" class="btn btn-success" value="submit">
      <a href="/index.php" class="btn btn-danger">cancel</a>
    </div>
    </form>
  </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  document.querySelector("textarea").addEventListener('keydown',function(e) {
  if(e.keyCode === 9) { // tab was pressed
      // get caret position/selection
      var start = this.selectionStart;
      var end = this.selectionEnd;

      var target = e.target;
      var value = target.value;

      // set textarea value to: text before caret + tab + text after caret
      target.value = value.substring(0, start)
                  + "\t"
                  + value.substring(end);

      // put caret at right position again (add one for the tab)
      this.selectionStart = this.selectionEnd = start + 1;

      // prevent the focus lose
      e.preventDefault();
  }
  },false);
</script>

</body>
</html>
