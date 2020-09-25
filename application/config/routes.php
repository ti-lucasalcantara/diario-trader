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

/**
*------------------------- Client Routes
*/

// Dashboard
$route['dashboard']     = 'client/dashboard';

// Order
$route['order']         = 'client/order';
$route['order/create']  = 'client/order/create';
$route['order/save']    = 'client/order/save';

// Product
$route['product']               = 'client/product';
$route['product/page/(:num)']   = 'client/product/index/$1';
$route['product/show']          = 'client/product/show';
$route['product/show/(:any)']   = 'client/product/show/$1';
$route['product/create']        = 'client/product/create';
$route['product/insert']        = 'client/product/insert';
$route['product/insert-image']  = 'client/product/insertImage';
$route['product/edit/(:any)']   = 'client/product/edit/$1';
$route['product/update']        = 'client/product/update';

// Client
$route['client']              = 'client/client';
$route['client/show']         = 'client/client/show';
$route['client/show/(:any)']  = 'client/client/show/$1';
$route['client/show-params']  = 'client/client/showByParams';
$route['client/create']       = 'client/client/create';
$route['client/insert']       = 'client/client/insert';
$route['client/edit/(:any)']  = 'client/client/edit/$1';
$route['client/update']       = 'client/client/update';
$route['client/delete']       = 'client/client/delete';
$route['client/restore']      = 'client/client/restore';


// Report
$route['report']    = 'client/report';

// Settings
$route['settings']  = 'client/settings';

// Revenue
$route['revenue']   = 'client/revenue';

// Expense
$route['expense']   = 'client/expense';

// Users
$route['users']     = 'client/users';

// Profile
$route['profile']   = 'client/profile';




// Measurements
$route['measurements']              = 'client/measurements';
$route['measurements/show']         = 'client/measurements/show';
$route['measurements/show/(:any)']  = 'client/measurements/show/$1';
$route['measurements/insert']       = 'client/measurements/insert';
$route['measurements/update']       = 'client/measurements/update';
$route['measurements/delete']       = 'client/measurements/delete';
$route['measurements/restore']      = 'client/measurements/restore';

// Product Categories
$route['product-categories']              = 'client/productCategories/show';
$route['product-categories/show']         = 'client/productCategories/show';
$route['product-categories/show/(:any)']  = 'client/productCategories/show/$1';
$route['product-categories/insert']       = 'client/productCategories/insert';
$route['product-categories/update']       = 'client/productCategories/update';
$route['product-categories/delete']       = 'client/productCategories/delete';
$route['product-categories/restore']      = 'client/productCategories/restore';

// Product Images
$route['product-images']              = 'client/productImages/show';
$route['product-images/show']         = 'client/productImages/show';
$route['product-images/show/(:any)']  = 'client/productImages/show/$1';
$route['product-images/insert']       = 'client/productImages/insert';
$route['product-images/update']       = 'client/productImages/update';
$route['product-images/delete']       = 'client/productImages/delete';
$route['product-images/restore']      = 'client/productImages/restore';

/**
*------------------------- Client Routes //
*/



/**
 * Admin Routes
 */
