<?php foreach ($users as $user) : ?>
    Name:<?= $user->name ?></br>Email:<span><?= $user->email ?></span>
    <form action="changeuserinfo" method="post">
        <input type="hidden" name="user[id]" value="<?= $user->id ?>">
        <select name="user[role]" id="" value="<?= $user->role ?>">
            <option value="teacher" <?php if ($user->role == 'teacher') echo 'selected' ?>>Teacher</option>
            <option value="student" <?php if ($user->role == 'student') echo 'selected' ?>>Student</option>
        </select>
        <select name="user[permissions]" id="">
            <option value="0" <?php if ($user->permissions == '0') echo 'selected' ?>>Normal User</option>
            <option value="1" <?php if ($user->permissions == '1') echo 'selected' ?>>Priviledged User</option>
            <option value="7" <?php if ($user->permissions == '7') echo 'selected' ?>>admin</option>
        </select>
        <input type="submit" value="Edit Info">
    </form>
    <form action="resetpassword" method="post">
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <input type="submit" value="Reset Password">
    </form>
    </br></br>
<?php endforeach; ?>