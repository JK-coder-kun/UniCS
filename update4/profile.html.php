<div class='container-fluid mt-3 mb-3 p-3'>
    <h4>Profile</h4>
    <hr>
    <div style='width:40%'>
        <div class="input-group row m-2">
            <span class="input-group-text input-group-text-dark col-sm-4">User ID</span>
            <input type="text" readonly disabled class="form-control dummy-form-input-group col-sm-auto" value="<?= $userInfo['id'] ?>">
        </div>
        <div class="input-group row m-2">
            <span class="input-group-text input-group-text-dark col-sm-4">User Name</span>
            <input type="text" readonly disabled class="form-control dummy-form-input-group" value="<?= $userInfo['name'] ?>">
        </div>
        <div class="input-group row m-2">
            <span class="input-group-text input-group-text-dark col-sm-4">Email</span>
            <input type="text" readonly disabled class="form-control dummy-form-input-group" value="<?= $userInfo['email'] ?>">
        </div>
        <div class="input-group row m-2">
            <span class="input-group-text input-group-text-dark col-sm-4">Role</span>
            <input type="text" readonly disabled class="form-control dummy-form-input-group" value="<?= $userInfo['role'] ?>">
        </div>
        <div class="input-group row m-2">
            <span class="input-group-text input-group-text-dark col-sm-4">Account Type</span>
            <input type="text" readonly disabled class="form-control dummy-form-input-group" value="<?= $userInfo['permissions'] < 1 ? 'Normal User' : ($userInfo['permissions'] < 4 ? 'Priviledged User' : 'Admin') ?>">
        </div>
    </div>
    <form action="changepassword" method="post" class='mt-4 mb-4'>
        <input type="hidden" name="id" value=<?= $userInfo['id'] ?>>
        <div class="row m-2">
            <label for="oldpassword" class='col-sm-2 col-form-label'>Old Password</label>
            <span class="col-sm-auto">
                <input type="password" class="form-control" name="oldpassword" id="">
            </span>
        </div>
        <div class="row m-2">
            <label for="newpassword" class='col-sm-2 col-form-label'>New Password</label>
            <span class="col-sm-auto">
                <input type="password" class="form-control" name="newpassword" id="">
            </span>
        </div>
        <input type="submit" class='btn btn-primary' value="Change Password">
    </form>

    <!-- red highlight -->
    <span style='color:red'><?= $error ?? '' ?></span>

    <!-- green highlight -->
    <span style='color:green'><?= $successMessage ?? '' ?></span>

    <div class='mt-4 mb-4'>
        <?php if ($userInfo['permissions'] != 0) : ?>
            <h5>Your Requests' Approvals</h5>

            <table class='table table-hover table-light table-bordered border-dark' style='text-align:center;'>
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Period</th>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($approvals as $approval) : ?>
                        <tr>
                            <td><?= $approval->roomNo ?></td>
                            <td><?= $approval->period ?></td>
                            <td><?= $approval->day ?></td>
                            <td><?= $approval->date ?></td>
                            <td><?= $approval->reason ?></td>
                        </tr>
                        <!-- room Number:<?= $approval->roomNo ?>&emsp14;
                        period:<?= $approval->period ?>&emsp14;
                        day:<?= $approval->day ?>&emsp14;
                        date:<?= $approval->date ?>&emsp14;
                        reason:<?= $approval->reason ?> -->
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>