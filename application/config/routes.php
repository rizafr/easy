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

$route['login'] = "content/pages/login";
$route['signup'] = "content/pages/signup";

$route['authentication/login'] = 'authentication/login';
$route['authentication/signup'] = 'authentication/signup';
$route['authentication/logout'] = 'authentication/logout';
$route['authentication/forgot'] = 'authentication/forgot';

$route['payment_notification'] = 'process/donation/payment_notification';
$route['payment/thankyoupage'] = 'process/donation/after_payment';
// $route['member/(:any)/(:any)/(:any)'] = 'content/pages/member/$1/$2/$3';
// $route['member/(:any)/(:any)'] = 'content/pages/member/$1/$2';
// $route['member/(:any)'] = 'content/pages/member/$1';

$route['process/(:any)'] = 'process/$1';

$route['api/(:any)/(:any)'] = "api/$1/$2";

$route['captcha/(:any)'] = "content/captcha/index/$1";

$route['image/(:any)/(:any)/(:any)/(:any)'] = "content/pages/image/$1/$2/$3/$4";

$route['search/(:any)'] = "content/pages/search/$1";
$route['data/search/(:any)/(:num)'] = "content/data/search/$1/$2";

/* $route['donate/send/(:num)'] = "module/donate/send/$1";
$route['donate/submit/(:num)'] = "module/donate/submit/$1";
$route['donate/confirm/(:num)'] = "process/donation/confirm/$1";
$route['donate/(:num)'] = "process/donation/index/$1"; */

$route['(:any)/comment'] = "content/comment/index/$1";

$route['(:any)/send'] = "content/send/index/$1";

$route['set-language/(:num)/(:any)'] = "content/settings/set-language/$1/$2";
$route['set-language/(:num)'] = "content/settings/set-language/$1";
$route['downloads/(:any)/(:any)'] = "content/downloads/index/$1/$2";
$route['(:any)/archive/(:num)/(:num)/(:num)'] = "content/pages/archive/$1/$2/$3/$4";
$route['(:any)/archive/(:num)/(:num)'] = "content/pages/archive/$1/$2/$3";
$route['(:any)/(:num)'] = "content/pages/index/$1/$2";
$route['(:any)'] = "content/pages/index/$1";

$route['default_controller'] = "content/pages/index";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
