<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** For Admin **/
$route['admin'] = "admin";
$route['admin/(:any)'] = "admin/$1";
$route['users'] = "users";

$route['users/(:any)'] = "users/$1";
$route['user_permissions'] = "user_permissions";
$route['user_permissions/(:any)'] = "user_permissions/$1";
$route['createcms'] = "createcms";
$route['createcms/(:any)'] = "createcms/$1";


$route['default_controller'] = 'homepage';
// $route['accounts/index'] = 'accounts/index';
$route['accounts'] = 'accounts/account_group';
$route['accounts/group'] = 'accounts/account_group';
$route['accounts/elimination'] = 'accounts/account_elimination';
$route['users/sign_in'] = 'users/sign_in';
$route['homepage/elimination'] = 'homepage/elimination';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
