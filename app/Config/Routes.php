<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('home/generateVoucher', 'Home::generateVoucher');
$routes->post('home/generateVoucher', 'Home::generateVoucher');
$routes->add('home/add_coupon', 'Home::add_coupon');
$routes->get('/', 'Home::generateVoucher');




