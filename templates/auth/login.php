<?php
use App\Inc\Session;
include(__DIR__.'/../common/header.php');
?>
<form action="/auth/validateLogin" method="post">
  <div class="container">
  <h2>Login Form</h2>
    <?php if(!empty(Session::getSessionParam('error'))){ ?>
    <p class="error">
      <?php
        echo Session::getSessionParam('error');
        Session::unsetSessionParam('error');
      ?>
    </p>
    <?php } ?>
    <?php if(!empty(Session::getSessionParam('success'))){ ?>
    <p class="success">
      <?php
        echo Session::getSessionParam('success');
        Session::unsetSessionParam('success');
      ?>
    </p>
    <?php } ?>        
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <input type="hidden" name="token" value="<?= $params['token'] ?? '' ?>">
    <button type="submit">Login</button>
    <label>
  </div>
</form>
<?php

include(__DIR__.'/../common/footer.php');