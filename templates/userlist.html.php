<?php foreach($users as $user):?>
    <span><?=$user->name?></span></br><span><?=$user->email?></span>
   <form action="user/resetPassword"><input type="hidden" name="user[id]" value="<?=$user->id?>">
   <input type="text" name="user[role]" id="" value="<?=$user->role?>">
   <input type="hidden" name="user[password]">
    <input type="submit" value="Reset Password"></form></br></br>
<?php endforeach;?>