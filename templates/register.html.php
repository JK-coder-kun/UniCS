<?php if (!empty($errors)) : ?>
	<div class="errors">
		<p>Your account could not be created, please check the following:</p>
		<ul>
			<?php foreach ($errors as $error) : ?>
				<li><?= $error ?></li>
			<?php endforeach; 	?>
		</ul>
	</div>
<?php endif; ?>
<form action="../admin/register" method="post">
	<label for="email">Your email address</label>
	<input name="user[email]" id="email" type="text" value="<?= $user['email'] ?? '' ?>"></br>

	<label for="role">Enter Role</label>
	<input name="user[role]" id="role" type="text" value="<?= $user['role'] ?? '' ?>" required></br>

	<label for="name">Your name</label>
	<input name="user[name]" id="name" type="text" value="<?= $user['name'] ?? '' ?>"></br>

	<label for="password">Password</label>
	<input name="user[password]" id="password" type="password" value="<?= $user['password'] ?? '' ?>"></br>

	<label for="permissions">User Type</label></br>
	<select name="user[permissions]" id="">
		<option value="0">Normal User</option>
		<option value="1">Priviledged User</option>
		<option value="7">admin</option>
	</select>


	<input type="submit" name="submit" value="Create account">
</form>