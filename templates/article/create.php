<?php

include(__DIR__.'/../common/header.php');
?>
<form action="/article/addArticle" method="post">
  <div class="container">
  <h2>Create Article</h2>
    <?php if(!empty($session::getSessionParam('error'))){ ?>
    <p class="error">
      <?php
        echo $session::getSessionParam('error');
        $session::unsetSessionParam('error');
      ?>
    </p>
    <?php } ?>
    <label for="title"><b>Title</b></label>
    <input type="text" placeholder="Enter Article Title" name="title" required value="<?php 
    echo $session::getSessionParam('title'); 
    $session::unsetSessionParam('title');
    ?>">

    <label for="title"><b>Image Link</b></label>
    <input type="text" placeholder="Enter Image Link" name="image" required value="<?php 
    echo $session::getSessionParam('image'); 
    $session::unsetSessionParam('image');
    ?>">    

    <label for="text"><b>Text</b></label>
    <textarea placeholder="Enter Email" name="text" required cols="15" rows="10"> 
        <?php 
        echo $session::getSessionParam('text'); 
        $session::unsetSessionParam('text');
        ?>
    </textarea>
        
    <input type="hidden" name="token" value="<?= $params['token'] ?? '' ?>">
    <button type="submit">Create Article</button>
    <label>
  </div>
</form>
<?php

include(__DIR__.'/../common/footer.php');