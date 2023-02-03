<?php
namespace Common;

use Exception;

class EntryPoint {
	private $route;
	private $method;
	private $routes;
	public function __construct(string $route, string $method, \Unics\Routes $routes) {
		$this->route = $route;
		$this->routes = $routes;
		$this->method = $method;
		$this->checkUrl();
	}

	private function checkUrl() {
		if ($this->route !== strtolower($this->route)) {
			http_response_code(301);
			header('location: ' . strtolower($this->route));
		}
	}

	private function loadTemplate($templateFileName, $variables = []) {
		extract($variables);

		ob_start();
		include  '/opt/lampp/htdocs/UniCS/'.'./templates/' . $templateFileName;

		return ob_get_clean();
	}

	public function run() {

		$routes = $this->routes->getRoutes();	

		$authentication = $this->routes->getAuthentication();

		$requestOperator=$this->routes->getRequestOperator();

		try{
			$requestOperator->checkRequests();	
			$requestOperator->deleteApproval();
		}catch(Exception $e){
			echo $e;
		}

		if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
			header('location: login/error');
		}
		else if (isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])) {
			header('location: login/permissionserror');	
		}
		else {
			$controller = $routes[$this->route][$this->method]['controller'];
			$action = $routes[$this->route][$this->method]['action'];
			$page = $controller->$action();

			$title = $page['title'];

			if (isset($page['variables'])) {
				$output = $this->loadTemplate($page['template'], $page['variables']);
			}
			else {
				$output = $this->loadTemplate($page['template']);
			}

			if($page['template']=='login.html.php'){
				echo $this->loadTemplate('loginlayout.html.php',[
																	'output'=>$output,
																	'title'=>$title		
				]);
			}else{
				$notifications=$this->routes->getNotification();
				echo $this->loadTemplate('layout.html.php', ['loggedIn' => $authentication->isLoggedIn(),
			                                             'output' => $output,
			                                             'title' => $title,
														 'notifications'=>$notifications
			                                            ]);
			}
			

		}

	}
}