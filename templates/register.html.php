<div class="mt-3 mb-3 p-3">
	<h4>Register Users</h4>
	<hr>

	<div class="container-fluid">
		<?php if (!empty($errors)) : ?>
			<div class="errors" style='color:red'>
				<p>Your account could not be created, please check the following:</p>
				<ul>
					<?php foreach ($errors as $error) : ?>
						<li><?= $error ?></li>
					<?php endforeach; 	?>
				</ul>
			</div>
		<?php endif; ?>
		<form action="register" method="post">
			<div class="row mb-3">
				<label for="email" class='col-sm-2 col-form-label'>Email address</label>
				<span class="col-sm-auto">
					<input name="user[email]" id="email" type="text" class='form-control' value="<?= $user['email'] ?? '' ?>">
				</span>
			</div>
			<div class="row mb-3">
				<label for="role" class='col-sm-2 col-form-label'>Enter Role</label>
				<span class="col-sm-auto">
					<input name="user[role]" id="role" type="text" class='form-control' value="<?= $user['role'] ?? '' ?>" required>
				</span>
			</div>
			<div class="row mb-3">
				<label for="name" class='col-sm-2 col-form-label'>Username</label>
				<span class="col-sm-auto">
					<input name="user[name]" id="name" type="text" class='form-control' value="<?= $user['name'] ?? '' ?>">
				</span>
			</div>
			<div class="row mb-3">
				<label for="password" class='col-sm-2 col-form-label'>Password</label>
				<span class="col-sm-auto">
					<input name="user[password]" id="password" type="password" class='form-control' value="<?= $user['password'] ?? '' ?>">
				</span>
			</div>
			<div class="row mb-3">
				<label for="permissions" class='col-sm-2 col-form-label'>User Type</label>
				<span class="col-sm-auto">
					<select name="user[permissions]" class='form-select' id="">
						<option value="0">Normal User</option>
						<option value="1">Priviledged User</option>
						<option value="7">Admin</option>
					</select>
				</span>
			</div>
			<div class="mt-4">
				<input type="submit" name="submit" class='btn btn-primary' value="Create account">
			</div>
		</form>
	</div>
</div>