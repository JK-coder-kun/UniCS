<?php

namespace Unics\Controllers;

class Login
{
	private $authentication;
	private $approvalTable;

	public function __construct(\Common\Authentication $authentication, \Common\DatabaseTable $approvalTable)
	{
		$this->authentication = $authentication;
		$this->approvalTable = $approvalTable;
	}

	public function loginForm()
	{
		return ['template' => 'login.html.php', 'title' => 'Log In'];
	}

	public function processLogin()
	{
		if ($this->authentication->login($_POST['email'], $_POST['password'])) {
			header('location: schedule');
		} else {
			return [
				'template' => 'login.html.php',
				'title' => 'Log In',
				'variables' => [
					'error' => 'Invalid username/password.'
				]
			];
		}
	}

	public function showProfile()
	{
		$user = $this->authentication->getUser();
		$userInfo = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'role' => $user->role, 'permissions' => $user->permissions];
		$approvals = $this->approvalTable->find('userId', $user->id, 'date DESC');
		$title = "Profile";
		return [
			'template' => 'profile.html.php',
			'title' => $title,
			'variables' => [
				'userInfo' => $userInfo,
				'approvals' => $approvals
			]
		];
	}

	public function changePassword()
	{
		$user = $this->authentication->getUser();
		if (isset($_POST['oldpassword']) && $_POST['oldpassword'] != "" && isset($_POST['newpassword']) && ($_POST['newpassword'] != "")) {
			$oldpassword = $_POST['oldpassword'];
			$newpassword = $_POST['newpassword'];

			if (!empty($user) && password_verify($oldpassword, $user->password)) {
				$newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
				$this->authentication->changePassword($user->id,$user->email, $newpassword);
				$userInfo = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'role' => $user->role, 'permissions' => $user->permissions];
				$approvals = $this->approvalTable->find('userId', $user->id, 'date DESC');
				$successMessage="Your Password have been successfully changed";
				$title = "Profile";
				return [
					'template' => 'profile.html.php',
					'title' => $title,
					'variables' => [
						'userInfo' => $userInfo,
						'approvals' => $approvals,
						'successMessage'=>$successMessage
					]
				];
			} else {
				$userInfo = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'role' => $user->role, 'permissions' => $user->permissions];
				$approvals = $this->approvalTable->find('userId', $user->id, 'date DESC');
				$error = "Your old password is not correct";
				$title = "Profile";
				return [
					'template' => 'profile.html.php',
					'title' => $title,
					'variables' => [
						'userInfo' => $userInfo,
						'approvals' => $approvals,
						'error' => $error
					]
				];
			}
		} else {
			$userInfo = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'role' => $user->role, 'permissions' => $user->permissions];
			$approvals = $this->approvalTable->find('userId', $user->id, 'date DESC');
			$error = "You have to fill Both Old and New passoword to change new passoword";
			$title = "Profile";
			return [
				'template' => 'profile.html.php',
				'title' => $title,
				'variables' => [
					'userInfo' => $userInfo,
					'approvals' => $approvals,
					'error' => $error
				]
			];
		}
	}

	public function success()
	{
		return [
			'template' => 'loginsuccess.html.php', 'title' => 'Login Successful', 'variable' => ['loggedIn' => true]
		];
	}

	public function error()
	{
		return ['template' => 'loginerror.html.php', 'title' => 'You are not logged in'];
	}

	public function permissionsError()
	{
		return ['template' => 'permissionserror.html.php', 'title' => 'Access Denied'];
	}

	public function logout()
	{
		unset($_SESSION);
		session_destroy();
		return ['template' => 'login.html.php', 'title' => 'You have been logged out'];
	}
}
