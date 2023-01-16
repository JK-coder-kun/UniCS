<?php
namespace Unics\Entity;
class User{
    const REQUEST_ROOM=1;
    const EDIT_SCHEDULE=2;
    const EDIT_PERMISSION=4;

    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $permissions;

    public function hasPermission($permission) {
		return $this->permissions & $permission;  
	}
}