<?php
namespace Unics;
class Routes{
    private $scheduleTable;
    private $authentication;
    private $userTable;
    private $approvalTable;
    private $requestTable;
    private $notificationTable;

    public function __construct(){
        include '/opt/lampp/htdocs/UniCS/'.'./includes/DatabaseConnection.php';
        $this->scheduleTable=new \Common\DatabaseTable($pdo,'schedule','period' ,'\Unics\Entity\Schedule');
        $this->userTable=new \Common\DatabaseTable($pdo,'user','id','\Unics\Entity\User');
        $this->approvalTable=new \Common\DatabaseTable($pdo,'approval','id');
        $this->requestTable=new \Common\DatabaseTable($pdo,'request','id','\Unics\Entity\Request');
        $this->notificationTable=new \Common\DatabaseTable($pdo,'notification','userId');
        $this->authentication=new \Common\Authentication($this->userTable,'email','password','\Unics\Entity\Schedule');
    
    }
    
    public function getRoutes(){
        $loginController= new \Unics\Controllers\Login($this->authentication);
        $registerController=new \Unics\Controllers\Register($this->userTable);
        $scheduleController=new \Unics\Controllers\Schedule($this->scheduleTable,$this->approvalTable);
        $requestController=new \Unics\Controllers\Request($this->scheduleTable,$this->requestTable,$this->approvalTable,$this->authentication,$this->notificationTable);
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
            'login/permissionserror'=>[
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
            ],
            'request'=>[
                'GET'=>[
                    'controller'=>$requestController,
                    'action'=>'showRoomSchedule'
                ],
                'POST'=>[
                    'controller'=>$requestController,
                    'action'=>'sendRequest'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::REQUEST_ROOM
            ]
        ];
        return $routes;
    }

    public function getAuthentication(): \Common\Authentication {
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

