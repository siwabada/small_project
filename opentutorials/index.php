<?php
  require('config/config.php');
  require('lib/db.php');
  // DB 서버($conn)에서 조회할 테이블 (topic)의 모든 정보를 가져온다. 결과값을 $result 변수에 저장
  $conn = db_init($config['host'],$config['duser'],$config['dpw'],$config['dname']);
  // select * from board order by author = '-_-' desc, author
  // $result = mysqli_query($conn, 'SELECT * FROM topic order by id desc');
  // id = 94를 최상단에, id 내림차순으로 정렬
  $result = mysqli_query($conn, 'SELECT * FROM topic order by id = 94 desc, id = 102 desc, id desc');
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
    <?php
      if(empty($_GET['id']) === true){
    ?>
      <div class="table-responsive">
        <table class="table table-striped text-center table-bordered">
          <tr class="active">
            <td width="5%">#</td>
            <td width="50%">title</td>
            <td width="10%">author</td>
            <td width="15%">created</td>
          </tr>
          <?php
            $i = 1;
            while($row = mysqli_fetch_assoc($result)){
          ?>
            <tr>
              <td width="5%"><?= $i?></td>
              <!-- identifier를 통한 comment count fetch시에는 옆의 attribute를 a 링크에 포함시킴 data-disqus-identifier='<?=$row['id']?>' -->
              <td width="50%" class="table-title"><a href="/index.php?id=<?=$row['id']?>"><?=$row['title']?></a><span class="comment"><a href="/index.php?id=<?=$row['id']?>#disqus_thread"></a></span></td>
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
          <span class='description'><?=nl2br($row['description'])?></span>
        </div>
      </div>
      <a href="/modify.php?id=<?=$row['id']?>" class="btn btn-warning">modify</a>
      <a id="del_btn" class="btn btn-danger">delete</a>
      <div id="disqus_thread"></div>
    <?}?>
    </div>
  </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  var del_btn = document.getElementById('del_btn');
  del_btn.addEventListener('click', function(){
    var result = confirm('정말로 삭제 하시겠습니까??');
    if(result === true){
      alert('삭제완료')
      //해당 url 페이지로 이동시킨다.
      location.replace("./process.php?mode=delete&id=<?=$_GET['id']?>");
    }else{
      location.replace("./index.php?id=<?php $_GET['id'] ?>");
    }
  })
</script>
<!-- 댓글위젯추가 -->
<script>
/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

/*
var disqus_config = function () {
this.page.url ="http://siwabada.dothome.co.kr/index.php?id=<?=$row['id']?>";
// Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = '<?=$row['id']?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
// DON'T EDIT BELOW THIS LINE
// n() {
// var d = document, s = d.createElement('script');
// s.src = '//monkey-sunshine.disqus.com/embed.js';
// s.setAttribute('data-timestamp', +new Date());
// (d.head || d.body).appendChild(s);
// })();

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//monkey-sunshine.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();

</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<script id="dsq-count-scr" src="//monkey-sunshine.disqus.com/count.js" async></script>
<script>
</script>
</body>
</html>
