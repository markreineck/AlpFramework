<?php
/*
Copyright (c) 2012-2015, Nth Generation. All rights reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/
@session_start();

$CONTROLLER_INDEX = 0;

$version = phpversion();

$v = explode('.',$version);
if ($v[0] < 5) {
	echo "PHP version 5.0 or greater is required. You are currently using version $version<br>";
	exit;
}

require_once('Alp/system/core.php');

// Load and execute the framework initialization
//$pagestr = (empty($_GET['p'])) ? 'index' : $_GET['p'];

$pagestr = '';

if (isset($_GET['p']))
	$pagestr = $_GET['p'];
if (!$pagestr && isset($argv[1]))
	$pagestr = $argv[1];

$page = explode('/',$pagestr);

$controller = 'index';
while ($CONTROLLER_INDEX >= 0) {
	if (isset($page[$CONTROLLER_INDEX]) && $page[$CONTROLLER_INDEX]) {
		$controller = $page[$CONTROLLER_INDEX];
		$CONTROLLER_INDEX = -1;
	} else
		$CONTROLLER_INDEX -= 1;
}

if (substr($page[0],0,5) == 'test:') {
	// Run test cases
	require_once('Alp/system/testcontroller.php');
	$pagestr = substr($pagestr,5);
	require_once('Alp/test/' . $pagestr . '.php');
	$classname = end($page);
	$testcase = new $classname($this);
	$controller = new TestController($testcase);
} else {
	// Run a live controller
	$path = 'Alp/controllers/' . $controller . '.php';
	if (file_exists($path)) {
		include($path);
		if (!isset($ControllerClassName))
			$ControllerClassName = $controller;
// Tests.com pages with dashes
		$controller = str_replace('-','',$controller);
		$controller = new $ControllerClassName($page);
	} else {
		include('Alp/controllers/notfound.php');
		$controller = new notfound($page);
	}
	$controller->Launch();
}

?>