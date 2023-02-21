<?php
namespace Unics;
class Routes{
    private $scheduleTable;
    private $authentication;
    private $userTable;
    private $approvalTable;
    private $requestTable;
    private $notificationTable;
    private $priorityTable;


    public function __construct(){
        include '/opt/lampp/htdocs/UniCS/'.'./includes/DatabaseConnection.php';
        $this->scheduleTable=new \Common\DatabaseTable($pdo,'schedule','id' ,'\Unics\Entity\Schedule');
        $this->userTable=new \Common\DatabaseTable($pdo,'user','id','\Unics\Entity\User');
        $this->approvalTable=new \Common\DatabaseTable($pdo,'approval','id');
        $this->requestTable=new \Common\DatabaseTable($pdo,'request','id','\Unics\Entity\Request');
        $this->notificationTable=new \Common\DatabaseTable($pdo,'notification','id');
        $this->priorityTable=new \Common\DatabaseTable($pdo,'priority','reason');
        $this->authentication=new \Common\Authentication($this->userTable,'email','password','\Unics\Entity\Schedule');
    
    }
    
    public function getRoutes(){
        $loginController= new \Unics\Controllers\Login($this->authentication,$this->approvalTable);
        $registerController=new \Unics\Controllers\Register($this->userTable);
        $scheduleController=new \Unics\Controllers\Schedule($this->scheduleTable,$this->approvalTable);
        $requestController=new \Unics\Controllers\Request($this->scheduleTable,$this->requestTable,$this->approvalTable,$this->authentication,$this->priorityTable,$this->notificationTable);
        $adminController=new \Unics\Controllers\Admin($this->priorityTable,$this->userTable,$this->scheduleTable,$this->approvalTable);
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
            'permissionserror'=>[
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
            'profile'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'showProfile'
                ],
                'login'=>true
            ],
            'admin/priority'=>[
                'GET'=>[
                    'controller'=>$adminController,
                    'action'=>'getPriorityOrder'
                ],
                'POST'=>[
                    'controller'=>$adminController,
                    'action'=>'savePriorityOrder'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_SCHEDULE
            ],
            'admin/listschedule'=>[
                'GET'=>[
                    'controller'=>$adminController,
                    'action'=>'listSchedule'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_SCHEDULE
            ],
            'admin/deleteschedule'=>[
                'POST'=>[
                    'controller'=>$adminController,
                    'action'=>'deleteSchedule'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_SCHEDULE
            ],
            'admin/editschedule'=>[
                
                'POST'=>[
                    'controller'=>$adminController,
                    'action'=>'editSchedule'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_SCHEDULE
            ],
            'admin/addschedule'=>[
                'POST'=>[
                    'controller'=>$adminController,
                    'action'=>'addSchedule'
                ],
                'login'=>true,
                'permissins'=>\Unics\Entity\User::EDIT_SCHEDULE
            ],
            'searchschedule'=>[
                'GET'=>[
                    'controller'=>$scheduleController,
                    'action'=>'searchSchedule'
                ],
                'login'=>true
            ],
            'changepassword'=>[
                'POST'=>[
                    'controller'=>$loginController,
                    'action'=>'changePassword'
                ],
                'loigin'=>true
            ],
            'register'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'registerationForm'
                ],
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'registerUser'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_PERMISSION
                ],
            'register/success'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'success'
                ]
                ],
            'listuser'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'list'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_PERMISSION
                ],
            'changeuserinfo'=>[
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'changeInfo'
                ],
                'login'=>true,
                'permissions'=>\Unics\Entity\User::EDIT_PERMISSION
            ],
            'resetpassword'=>[
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'resetPassword'
                ],
                'login'=>true,
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
            'room'=>[
                'GET'=>[
                    'controller'=>$requestController,
                    'action'=>'showRoomSchedule'
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

    public function getNotification(){
        $userId=$this->authentication->getUser()->id;
        $notifications=$this->notificationTable->find('userId',$userId,'id DESC');
        $totalUnread=$this->notificationTable->total(['userId'=>$userId,'status'=>'1']);
        return [
            'notifications'=>$notifications,
            'totalUnread'=>$totalUnread
        ];
    }

    public function getRequestOperator(){
        $requestOperator=new \Unics\Controllers\RequestOperator($this->scheduleTable,
                                                                $this->approvalTable,
                                                                $this->requestTable,
                                                                $this->notificationTable);
        return $requestOperator;
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