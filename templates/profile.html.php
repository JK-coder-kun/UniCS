<!-- green highlight -->
<?=$successMessage??''?>
</br>
User ID:<?=$userInfo['id']?></br>
Name   :<?=$userInfo['name']?></br>
Email  :<?=$userInfo['email']?></br>
role   :<?=$userInfo['role']?></br>
Account Type:<?=$userInfo['permissions']<1?'Normal User':($userInfo['permissions']<4?'Priviledged User':'Admin')?></br>
</br>

<!-- red highlight -->
<?=$error??''?>
<form action="changepassword" method="post">
    <input type="hidden" name="id" value=<?=$userInfo['id']?>>
    <label for="oldpassword">Old Password</label>
    <input type="password" name="oldpassword" id=""></br>
    <label for="newpassword">New Password</label>
    <input type="password" name="newpassword" id="">
    <input type="submit" value="Change Password">
</form>
</br>
</br>
<h5>Your Requests' Approvals</h5>
<?php foreach($approvals as $approval):?>
    room Number:<?=$approval->roomNo?>&emsp14;
    period:<?=$approval->period?>&emsp14;
    day:<?=$approval->day?>&emsp14;
    date:<?=$approval->date?>&emsp14;
    reason:<?=$approval->reason?>
<?php endforeach?>