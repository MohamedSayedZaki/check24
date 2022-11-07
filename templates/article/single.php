<?php
include(__DIR__.'/../common/header.php');
?>
<div class="container">
<?php
$article = $params['article'][0];
?>
    <div class="row">
        <div class="col-md-12">
            <div class="fakeimg"><img src="<?= $article['image']; ?>"></div>            
            <h2><?= $article['title']; ?></h2>
            <h5><span><?= $article['create_date']; ?></span> | <span><?= $article['username']; ?></span></h5>
            <p><?= $article['text']; ?>..</p>
        </div>
    </div>
</div>
<?php
include(__DIR__.'/../common/footer.php');