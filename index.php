<?php

session_start();

// Load core classes
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Router.php';

// Create router
$router = new Router();

// Home
$router->get('home', 'HomeController', 'index');

// Programmes
$router->get('programmes',        'ProgrammeController', 'index');
$router->get('programme-details', 'ProgrammeController', 'show');

// Modules
$router->get('modules', 'ModuleController', 'index');

// Staff
$router->get('staff', 'StaffController', 'index');
$router->get('staff-profile', 'StaffController', 'show');

// Interest
$router->get('interest',          'InterestController', 'showForm');
$router->post('interest',         'InterestController', 'submit');
$router->get('withdraw',          'InterestController', 'showWithdraw');
$router->post('withdraw',         'InterestController', 'withdraw');

// Auth
$router->get('login',    'AuthController', 'showLogin');
$router->post('login',   'AuthController', 'login');
$router->get('logout',   'AuthController', 'logout');
$router->get('register', 'AuthController', 'showRegister');
$router->post('register','AuthController', 'register');

// Admin
$router->get('admin',  'AdminController', 'index');
$router->post('admin', 'AdminController', 'handlePost');
$router->get('export', 'AdminController', 'exportCsv');

// Dispatch
$router->dispatch($_SERVER['REQUEST_METHOD']);