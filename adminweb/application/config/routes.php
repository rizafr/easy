<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['404_override'] = "common/error/index/404";

$route['captcha/login'] = "common/captcha/index/login";

$route['login'] = "common/login";
$route['authenticate/(:any)'] = "common/authenticate/$1";
$route['dashboard'] = "common/dashboard";

$route['inquiry/download/(:num)/(:any)'] = "inquiry/inquiry/download/$1/$2";
$route['inquiry/(:num)/(:num)'] = "inquiry/inquiry/detail/$1/$2";

$route['comment/(:num)/(:num)'] = "comment/comment/index/$1/$2";

$route['(:any)/(:any)/add'] = "$1/$2/add";
$route['(:any)/(:any)/view/(:num)'] = "$1/$2/view/$3";
$route['(:any)/(:any)/edit/(:num)'] = "$1/$2/edit/$3";
$route['(:any)/(:any)/delete/(:num)'] = "$1/$2/delete/$3";
$route['(:any)/(:any)/(:any)/(:num)'] = "$1/$2/$3/$4";
$route['(:any)/(:any)/(:any)'] = "$1/$2/$3";
$route['(:any)/(:any)'] = "$1/$2";
$route['(:any)'] = "$1";

$route['default_controller'] = "common/dashboard";


/* End of file routes.php */
/* Location: ./application/config/routes.php */