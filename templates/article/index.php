<?php
include(__DIR__.'/../common/header.php');
?>
<div class="container">
<?php
foreach($params['articles'] as $article){
?>
    <div class="row">
        <div class="col-md-6">
            <h2><a href="/article/getArticle/<?= $article['id']; ?>"><?= $article['title']; ?></a></h2>
            <h5><?= $article['create_date']; ?></h5>
            <p><?= $article['text']; ?>..</p>
            <a href="/article/getArticle/<?= $article['id']; ?>"><?= $article['username']; ?></a>
        </div>
        <div class="col-md-6">
            <div class="fakeimg" style="height:200px;"><img src="<?= $article['image']; ?>"></div>
        </div>
    </div>
<?php
}
?>
<div class="pagination">
  <a href="#">&laquo;</a>
  <a href="#">1</a>
  <a class="active" href="#">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>
</div>
</div>
<?php
include(__DIR__.'/../common/footer.php');