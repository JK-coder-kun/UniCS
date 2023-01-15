<?php
namespace Unics;
class Routes{
    private $scheduleTable;
    private $authentication;
    private $userTable;

    public function __construct(){
        include '/../includes/DatabaseConnection.php';
        $this->scheduleTable=new \Ninja\DatabaseTable($pdo,'schedule','period' );
        $this->userTable=new \Ninja\DatabaseTable($pdo,'user','id');
        $this->authentication=new \Ninja\Authentication($this->userTable,'email','password');
    
    }
    
    public function getRoutes(){
        $loginController= new \Unics\Controllers\Login($this->authentication);
        $registerController=new \Unics\Controllers\Register($this->userTable);
        $routes=[
            ''=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'loginForm'
                ]
                ],
            'login'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'loginForm'
                ],
                'POST'=>[
                    'controller'=>$loginController,
                    'action'=>'processLogin'
                ]
                ],
            'login/success'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'success'
                ]
                ],
            'login/error'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'error'
                ]
                ],
            'login/permissionerror'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'permissionsError'
                ]
                ],
            'register'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'registerForm'
                ],
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'registerUser'
                ]
                ],
            'register/success'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'success'
                ]
                ],
            'user/list'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'list'
                ],
                'permissions'=>\Unics\Entity\User::EDIT_PERMISSION
                ],
            'editpermission'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'permissions'
                ],
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'savePermissions'
                ],
                'permissions'=>\Unics\Entity\User::EDIT_PERMISSION
            ]
        ];
        return $routes;
    }

    public function getAuthentication(): \Ninja\Authentication {
		return $this->authentication;
	}

    public function checkPermission($permission): bool {
		$user = $this->authentication->getUser();

		if ($user && $user->hasPermission($permission)) {
			return true;
		} else {
			return false;
		}
	}

}

