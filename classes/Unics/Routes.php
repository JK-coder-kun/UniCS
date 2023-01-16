<?php
namespace Unics;
class Routes{
    private $scheduleTable;
    private $authentication;
    private $userTable;

    public function __construct(){
        include '/opt/lampp/htdocs/UniCS/'.'./includes/DatabaseConnection.php';
        $this->scheduleTable=new \Ninja\DatabaseTable($pdo,'schedule','period' );
        $this->userTable=new \Ninja\DatabaseTable($pdo,'user','id','\Unics\Entity\User');
        $this->authentication=new \Ninja\Authentication($this->userTable,'email','password','\Unics\Entity\Schedule');
    
    }
    
    public function getRoutes(){
        $loginController= new \Unics\Controllers\Login($this->authentication);
        $registerController=new \Unics\Controllers\Register($this->userTable);
        $scheduleController=new \Unics\Controllers\Schedule($this->scheduleTable);
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
            'logout'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'logout'
                ]
            ],
            'register'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'registerationForm'
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
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_PERMISSION
            ],
            'schedule'=>[
                'GET'=>[
                    'controller'=>$scheduleController,
                    'action'=>'showSchedule'
                ],
                'login'=>true
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

