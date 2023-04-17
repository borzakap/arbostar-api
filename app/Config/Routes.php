<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Test');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/', ['namespace' => 'App\Controllers\Analytics'], function($routes){
    $routes->get('', 'Dashboard::index');
    $routes->get('contragents-effectivenes', 'Dashboard::contragentsEffectivnes', ['as' => 'contragents_effectivenes']);
    $routes->get('stages-effectivenes', 'Dashboard::stagesEffectivenes', ['as' => 'stages_effectivenes']);
    $routes->group('currencies', function($routes){
        $routes->get('', 'Currencies::index', ['as' => 'currentcies_list']);
        $routes->get('switch/(:num)', 'Currencies::switch/$1', ['as' => 'currentcies_switch']);
    });
    $routes->group('contragents', function($routes){
        $routes->get('', 'Contragents::index', ['as' => 'contragents_list']);
        $routes->match(['get', 'post'], 'insert', 'Contragents::insert', ['as' => 'contragents_insert']);
        $routes->match(['get', 'post'], 'update/(:num)', 'Contragents::update/$1', ['as' => 'contragents_update']);
    });
    $routes->group('conditions', function($routes){
        $routes->post('insert', 'ContragentsCondigions::insert', ['as' => 'conditions_insert']);
        $routes->get('delete/(:num)', 'ContragentsCondigions::delete/$1', ['as' => 'conditions_delete']);
    });
    $routes->group('payments', function($routes){
        $routes->get('', 'Payments::index', ['as' => 'payments_list']);
        $routes->match(['get', 'post'], 'insert', 'Payments::insert', ['as' => 'payments_insert']);
        $routes->match(['get', 'post'], 'update/(:num)', 'Payments::update/$1', ['as' => 'payments_update']);
        $routes->get('delete/(:num)', 'Payments::delete/$1', ['as' => 'payments_delete']);
    });
    $routes->group('deals', function($routes){
        $routes->get('', 'Deals::index', ['as' => 'deals_list']);
        $routes->get('view/(:num)', 'Deals::view/$1', ['as' => 'deals_view']);
        $routes->get('find-contragent/(:num)', 'Deals::findContragent/$1', ['as' => 'deals_find_contragent']);
    });
    
    // log
    $routes->post('log', 'WebHook::index');
    
});
//$routes->post('log', 'Test::index');
//$routes->get('twiml', 'TwiML::index');
//$routes->post('calls-to-crm', 'CallsToCrm::index');
//$routes->post('callcomplited', 'CallComplited::index');

// get calllogs
$routes->cli('calllogs', 'GetCallLogs::index');
// sending sms
$routes->match(['get', 'post'], 'sms-sending', 'SmsSending::index');
// pipedrive oauth token callback
$routes->get('pipedrive-oauth-callback', 'PipedriveAuthCallback::index');

service('auth')->routes($routes);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
