<?php

namespace Unics\Controllers;

use \Common\DatabaseTable;

class Register
{
	private $userTable;

	public function __construct(DatabaseTable $userTable)
	{
		$this->userTable = $userTable;
	}

	public function registerationForm()
	{

		return [
			'template' => 'register.html.php',
			'title' => 'Register an account'
		];
	}


	public function success()
	{
		return [
			'template' => 'registersuccess.html.php',
			'title' => 'Registration Successful'
		];
	}

	public function registerUser()
	{
		$user = $_POST['user'];
		//Assume the data is valid to begin with
		$valid = true;
		$errors = [];

		//But if any of the fields have been left blank, set $valid to false
		if (empty($user['name'])) {
			$valid = false;
			$errors[] = 'Name cannot be blank';
		}

		if (empty($user['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		} else if (filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		} else { //if the email is not blank and valid:
			//convert the email to lowercase
			$user['email'] = strtolower($user['email']);

			//search for the lowercase version of `$user['email']`
			if (count($this->userTable->find('email', $user['email'])) > 0) {
				$valid = false;
				$errors[] = 'That email address is already registered';
			}
		}


		if (empty($user['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}
		if (empty($user['permissions']) && $user['permissions'] != 0) {
			$valid = false;
			$errors[] = 'User type cannot be blank';
		}
		//If $valid is still true, no fields were blank and the data can be added
		if ($valid == true) {
			//Hash the password before saving it in the database
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

			//When submitted, the $user variable now contains a lowercase value for email
			//and a hashed password

			$this->userTable->save($user);

			header('Location: listuser?search='.$user['email']);
		} else {
			//If the data is not valid, show the form again
			return [
				'template' => 'register.html.php',
				'title' => 'Register an account',
				'variables' => [
					'errors' => $errors,
					'user' => $user
				]
			];
		}
	}

	

	public function changeInfo()
	{
		if (isset($_POST['user'])) {
			$user = $_POST['user'];
			$this->userTable->update($user);
			header('Location:listuser');
		} else {
			header('Location:listuser');
		}
	}

	public function resetPassword()
	{
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$password = password_hash('unicsdefault@', PASSWORD_DEFAULT);
			$this->userTable->update(['id' => $id, 'password' => $password]);
			header('Location:listuser');
		} else {
			header('Location:listuser');
		}
	}

	public function list()
	{
		if (isset($_GET['search']) && $_GET['search'] != '') {
			$search = $_GET['search'];
			$users = $this->userTable->findMultiColumn(['email' => $search], 'name,permissions DESC,role DESC');
		} else {
			$users = $this->userTable->findAll('permissions DESC,role DESC,name');
		}


		return [
			'template' => 'userlist.html.php',
			'title' => 'User List',
			'variables' => [
				'users' => $users,
				'search' => $search ?? null
			]
		];
	}

	public function permissions()
	{

		$user = $this->userTable->findById($_GET['id']);

		$reflected = new \ReflectionClass('\Unics\Entity\User');
		$constants = $reflected->getConstants();

		return [
			'template' => 'permissions.html.php',
			'title' => 'Edit Permissions',
			'variables' => [
				'user' => $user,
				'permissions' => $constants
			]
		];
	}

	public function savePermissions()
	{
		$user = [
			'id' => $_GET['id'],
			'permissions' => array_sum($_POST['permissions'] ?? [])
		];

		$this->userTable->save($user);

		header('location: /user/list');
	}
}
