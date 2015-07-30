<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "/wishlists";
$route['register'] = '/wishlists/create';
$route['login'] = '/wishlists/login';
$route['dashboard'] = '/wishlists/dashboard';
$route['wish_items/create'] = '/wishlists/add_item';
$route['wish_items/create_item'] = '/wishlists/create_item';
$route['logoff'] = '/wishlists/destroy';
$route['wish_items/(:any)'] = '/wishlists/show/$1';
$route['add/wishlist/(:any)'] = '/wishlists/add_wishlist/$1';
$route['delete/wishlist/(:any)'] = '/wishlists/delete/$1';
$route['wish_items/(:any)'] = '/wishlists/wish_items/$1';
$route['remove/wishlist/(:any)'] = '/wishlists/remove/$1';
$route['404_override'] = '';


//end of routes.php