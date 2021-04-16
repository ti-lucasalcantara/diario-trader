<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']    = 'home';
$route['404_override']          = 'error404';
$route['translate_uri_dashes']  = FALSE;

$route['register']           = 'user/register';
$route['recovery-password']  = 'user/recoveryPassword';

$route['user/active/(:any)/(:any)']          = 'user/activeUser/$1/$2';
$route['user/reset-password/(:any)/(:any)']  = 'user/resetPassword/$1/$2';

$route['login']     = 'sessions/index';
$route['logout']    = 'sessions/logout';



/**
*------------------------- Client Routes
*/

// Dashboard
$route['dashboard'] = 'client/dashboard';


// Trading
$route['trading']              = 'client/trading/index';
$route['trading/date']         = 'client/trading/index';
$route['trading/date/(:any)']  = 'client/trading/index/$1';
$route['trading/show']         = 'client/trading/show';
$route['trading/show/(:any)']  = 'client/trading/show/$1';
$route['trading/show-params']  = 'client/trading/showByParams';
$route['trading/create']       = 'client/trading/create';
$route['trading/create/(:any)']= 'client/trading/create/$1';
$route['trading/insert']       = 'client/trading/insert';
$route['trading/edit/(:any)']  = 'client/trading/edit/$1';
$route['trading/update']       = 'client/trading/update';
$route['trading/delete']       = 'client/trading/delete';
$route['trading/restore']      = 'client/trading/restore';

/**
*------------------------- Client Routes //
*/



/**
*------------------------- Admin Routes
*/

// Dashboard
$route['admin/dashboard']     = 'admin/dashboard';

/**
*------------------------- Admin Routes //
*/
