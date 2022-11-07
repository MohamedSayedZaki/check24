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
$total_pages = ceil($params['articleCount'][0]['ArticleCount'] / 3);
?>
<div class="pagination">
    <?php if( $params['page'] -1 >= 1) { ?>
        <a href='/home/index/<?= $params['page'] - 1 ?>'>&laquo;</a>
    <?php } ?>
  
    <?php for($i=1; $i<=$total_pages; $i++){ ?>
    <a <?php if($i == $params['page']){ ?> class="active" <?php }else{ ?>href="/home/index/<?= $params['page']+1 ?>" <?php } ?>><?= $i ?></a>
    <?php } ?>
    <?php if( $params['page'] + 1 <= $total_pages) { ?>
        <td><a href="/home/index/<?= $params['page'] + 1 ?>">&raquo;</a></td>
    <?php } ?>
</div>
</div>
<?php
include(__DIR__.'/../common/footer.php');