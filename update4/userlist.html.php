<div class="mt-3 mb-3 p-3">
    <h4>User List</h4>
    <hr>

    <div class="container-fluid">
        <form action="listuser" method="get" class="row gx-2">
            <span class="col-sm-3">
                <input type="text" name="search" id="" class='form-control' value=<?= $search ?>>
            </span>
            <span class="col-sm-3">
                <input type="submit" value="Search" class="btn btn-primary">
            </span>
        </form>
        </br>

        <!-- background-color:#66ffb3 -->
        <div class="container-fluid p-4" style="background-color:lightgoldenrodyellow;border-radius:20px;">
            <div>
                <div class="row gx-1">
                    <span class='col-10'>
                        <form action="" class='mb-3 row'>
                            <span class='col-sm-2'>
                                <input type="text" readonly class="form-control-plaintext dummy-form-title" value="Name">
                            </span>
                            <span class='col-sm-3'>
                                <input type="text" readonly class="form-control-plaintext dummy-form-title" value="Email">
                            </span>
                            <span class='col-sm-2'>
                                <input type="text" readonly class="form-control-plaintext dummy-form-title" value="Role">
                            </span>
                            <span class='col-sm-3'>
                                <input type="text" readonly class="form-control-plaintext dummy-form-title" value="Account Type">
                            </span>
                            <span class="col-sm-2"></span>
                        </form>
                    </span>
                    <span class='col-2'></span>
                </div>

                <?php foreach ($users as $user) : ?>
                    <!-- Name:<?= $user->name ?></br>Email:<span><?= $user->email ?></span> -->
                    <div class="row gx-1">
                        <span class="col-10">
                            <form action="changeuserinfo" method="post" class='row'>
                                <span class="col-sm-2">
                                    <input type="text" readonly class='form-control-plaintext dummy-form-content' value="<?= $user->name ?>">
                                </span>
                                <span class="col-sm-3">
                                    <input type="text" readonly class='form-control-plaintext dummy-form-content' value="<?= $user->email ?>">
                                </span>
                                <input type="hidden" name="user[id]" value="<?= $user->id ?>">
                                <span class="col-sm-2">
                                    <select name="user[role]" class='form-select' value="<?= $user->role ?>">
                                        <option value="teacher" <?php if ($user->role == 'teacher') echo 'selected' ?>>Teacher</option>
                                        <option value="student" <?php if ($user->role == 'student') echo 'selected' ?>>Student</option>
                                    </select>
                                </span>
                                <span class="col-sm-3">
                                    <select name="user[permissions]" class='form-select'>
                                        <option value="0" <?php if ($user->permissions == '0') echo 'selected' ?>>Normal User</option>
                                        <option value="1" <?php if ($user->permissions == '1') echo 'selected' ?>>Priviledged User</option>
                                        <option value="7" <?php if ($user->permissions == '7') echo 'selected' ?>>admin</option>
                                    </select>
                                </span>
                                <span class="col-sm-2">
                                    <input type="submit" class="form-control btn btn-primary" style='border:0' value="Edit Info">
                                </span>
                            </form>
                        </span>
                        <span class="col-2">
                            <form action="resetpassword" method="post">
                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                <input type="submit" class='form-control btn btn-secondary' style='border:0' value="Reset Password">
                            </form>
                        </span>
                    </div>

                    </br></br>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>