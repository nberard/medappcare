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
$route['default_controller'] = "gp";
$route['^(fr|en)/([a-z]+)/app/[a-z0-9\-]+_(:num)$'] = "$2/app/$3";
$route['^(fr|en)/([a-z]+)/device/[a-z0-9\-]+_(:num)$'] = "$2/device/$3";
$route['^(fr|en)/([a-z]+)/category/[a-z0-9\-]+_(:num)$'] = "$2/category/$3";
$route['^(fr|en)/([a-z]+)/news/[a-z0-9\-]+_(:num)$'] = "$2/news/$3";
$route['^(fr|en)/([a-z]+)/list_news_(:num)$'] = "$2/list_news/$3";
$route['^(fr|en)/([a-z]+)/list_devices_(:num)$'] = "$2/list_devices/$3";
$route['^(fr|en)/([a-z]+)/app_category/[a-z0-9\-]+_(:num)_(:num)$'] = "$2/app_category/$3/$4";
$route['^(fr|en)/([a-z]+)/app_device/[a-z0-9\-]+_(:num)_(:num)$'] = "$2/app_device/$3/$4";
$route['^(fr|en)/([a-z]+)/app_search_(:num)$'] = "$2/app_search/$3";
$route['^(fr|en)/([a-z]+)/selection/[a-z0-9\-]+_(:num)$'] = "$2/selection/$3";

$route['^fr/(.+)$'] = "$1";
$route['^en/(.+)$'] = "$1";
$route['404_override'] = 'gp/error_404';
// '/en' and '/fr' -> use default controller
$route['^(fr|en)$'] = $route['default_controller'];
/* End of file routes.php */
/* Location: ./application/config/routes.php */