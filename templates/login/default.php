<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<? include 'templates/header.php'; ?>
<h1>Login</h1>
<p><?=Lang::$L_LOGIN_TEXT?></p>
<div id="login-div" class="mid-box-container">
	<form action="./?c=login&amp;a=login" method="post">
		<table class="raw-table">
		<tr>
			<td><label><?=Lang::$L_USERNAME?>:</label></td>
			<td><input type="text" name="username" value="<?=Lang::$L_USERNAME?>" /></td>
		</tr>
		<tr>
			<td><label><?=Lang::$L_PASSWORD?>:</label></td>
			<td><input type="password" name="password" value="<?=Lang::$L_PASSWORD?>" /></td>
		</tr>
		</table>
		<input type="submit" class="button" value="Login" />
	</form>
</div>
<? include 'templates/footer.php'; ?>
