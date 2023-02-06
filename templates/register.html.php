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
    <input name="user[email]" id="email" type="text" value="<?=$user['email'] ?? ''?>"></br>

	<label for="role">Enter Role</label>
    <input name="user[role]" id="role" type="text" value="<?=$user['role'] ?? ''?>" required></br>
    
    <label for="name">Your name</label>
    <input name="user[name]" id="name" type="text" value="<?=$user['name'] ?? ''?>"></br>

    <label for="password">Password</label>
    <input name="user[password]" id="password" type="password" value="<?=$user['password'] ?? ''?>"></br>

	<label for="permissions">User Type</label></br>
	Normal User:
    <input name="user[permissions]" id="permissions" type="radio" value="0"></br>
	Privilege User:
	<input name="user[permissions]" id="permissions" type="radio" value="<?=\Unics\Entity\User::REQUEST_ROOM?>"></br>
	Admin:
	<input name="user[permissions]" id="permissions" type="radio" value="7"></br>

 
    <input type="submit" name="submit" value="Create account">
</form>