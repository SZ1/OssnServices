<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('OssnServices', ossn_route()->com . 'OssnServices/');
ossn_register_class(array(
		'Ossn\Component\OssnServices' => OssnServices . 'classes/OssnServices.php'
));
/**
 * Initialize the services component  
 *
 * @return void
 */
function ossn_services_init() {
		ossn_register_com_panel('OssnServices', 'settings');
		ossn_register_page('api', 'ossn_services_handler');
		if(ossn_isAdminLoggedin()) {
				ossn_register_action('services/admin/settings', OssnServices . 'actions/settings.php');
		}
}
/**
 * Get the api key for the services
 *
 * @return string|boolean
 */
function ossn_services_apikey() {
		$component = new OssnComponents;
		$settings  = $component->getSettings('OssnServices');
		if(isset($settings->apikey)) {
				return $settings->apikey;
		}
		return false;
}
/**
 * Service handler
 * See the OssnServices::handle
 *
 * @return void
 */
function ossn_services_handler($requests) {
		(new \Ossn\Component\OssnServices())->handle($requests);
}

ossn_register_callback('ossn', 'init', 'ossn_services_init');