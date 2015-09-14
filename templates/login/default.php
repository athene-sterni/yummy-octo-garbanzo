<? include 'templates/header.php'; ?>
<h1>Login</h1>
<p><?=$L_LOGIN_TEXT?></p>
<div id="login-div" class="mid-box-container">
	<form action="./?c=login&amp;a=login">
		<table class="raw-table">
		<tr>
			<td><label><?=$L_USERNAME?>:</label></td>
			<td><input type="text" name="username" value="<?=$L_USERNAME?>" /></td>
		</tr>
		<tr>
			<td><label><?=$L_PASSWORD?>:</label></td>
			<td><input type="password" name="password" value="<?=$L_PASSWORD?>" /></td>
		</tr>
		</table>
		<input type="submit" class="button" value="Login" />
	</form>
</div>
<? include 'templates/footer.php'; ?>
