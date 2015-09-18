<?
if(!defined('YOG_INCLUDE'))
   die('Direct access not permitted');
?>

<? include 'templates/header.php'; ?>
<h1>Sign Up</h1>
<p><?=Lang::$L_SIGNUP_TEXT?></p>
<div id="login-div" class="mid-box-container">
	<form action="./?c=signup&amp;a=signup" method="post">
		<table class="raw-table">
		<tr>
			<td><label><?=Lang::$L_USERNAME?>:</label></td>
			<td><input type="text" name="username" value="<?=$this->_['username']?>" /></td>
		</tr>
		<tr>
			<td><label><?=Lang::$L_PASSWORD?>:</label></td>
			<td><input type="password" name="password" value="<?=$this->_['password']?>" /></td>
		</tr>
		<tr>
			<td><label><?=Lang::$L_EMAIL?>:</label></td>
			<td><input type="text" name="email" value="<?=$this->_['email']?>" /></td>
		</tr>
		</table>
		<input type="submit" class="button" value="Sign up" />
	</form>
</div>
<? include 'templates/footer.php'; ?>
