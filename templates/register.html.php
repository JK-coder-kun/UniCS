<?php if (!empty($errors)): ?>
	<div class="errors">
		<p>Your account could not be created, please check the following:</p>
		<ul>
		<?php foreach ($errors as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; 	?>
		</ul>
	</div>
<?php endif; ?>
<form action="../public/register" method="post">
    <label for="email">Your email address</label>
    <input name="user[email]" id="email" type="text" value="<?=$user['email'] ?? ''?>">
    
    <label for="name">Your name</label>
    <input name="user[name]" id="name" type="text" value="<?=$user['name'] ?? ''?>">

    <label for="password">Password</label>
    <input name="user[password]" id="password" type="password" value="<?=$user['password'] ?? ''?>">
 
    <input type="submit" name="submit" value="Register account">
</form>