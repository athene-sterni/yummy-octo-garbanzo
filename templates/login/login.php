<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<? include 'templates/header.php'; ?>
<h1>Login</h1>
<? if(isset($_SESSION['username'])) { ?>
<div class="success box" id="login-notice">
<p><?=sprintf(Lang::$L_LOGIN_SUCCESS, htmlify($_SESSION['username']))?></p>
</div>
<? } else { ?>
<div class="error box" id="login-notice">
<p><?=Lang::$L_LOGIN_ERROR?></p>
</div>
<? } ?>
<? include 'templates/footer.php'; ?>
