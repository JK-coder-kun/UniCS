<?php
namespace Ninja;

class EntryPoint {
	private $route;
	private $method;
	private $routes;
	public function __construct(string $route, string $method, \Unics\Routes $routes) {
		$this->route = $route;
		$this->routes = $routes;
		$this->method = $method;
        echo "entry point loaded</br>";
		//$this->checkUrl();
	}

	// private function checkUrl() {
	// 	if ($this->route !== strtolower($this->route)) {
	// 		http_response_code(301);
	// 		header('location: ' . strtolower($this->route));
	// 	}
	// }

	private function loadTemplate($templateFileName, $variables = []) {
		extract($variables);

		ob_start();
		include  '/opt/lampp/htdocs/UniCS/'.'./templates/' . $templateFileName;

		return ob_get_clean();
	}

	public function run() {

		$routes = $this->routes->getRoutes();	

		$authentication = $this->routes->getAuthentication();

		if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
			header('location: ');
		}
		else if (isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])) {
			header('location: index.php?route=`login/permissionserror`');	
		}
		else {
			$controller = $routes[$this->route][$this->method]['controller'];
			$action = $routes[$this->route][$this->method]['action'];
			echo "before call controller</br>";
			$page = $controller->$action();

			$title = $page['title'];

			if (isset($page['variables'])) {
				$output = $this->loadTemplate($page['template'], $page['variables']);
			}
			else {
				$output = $this->loadTemplate($page['template']);
			}

			echo $this->loadTemplate('layout.html.php', ['loggedIn' => $authentication->isLoggedIn(),
			                                             'output' => $output,
			                                             'title' => $title
			                                            ]);

		}

	}
}