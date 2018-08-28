<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright © SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
namespace Ossn\Component;
class OssnServices {
		/**
		 * Generate a random key 
		 * This is a random key generated
		 * A a key will be required to obtain the services 
		 *
		 * @return string
		 */
		public static function genKey() {
				return hash('ripemd256', md5() . microtime() . rand(0, 2));
		}
		/**
		 * Get a list of method for the api 
		 * These methods can be removed, overwritten using the ossn_hook
		 *
		 * @return array
		 */
		public function getMethods() {
				return ossn_call_hook('services', 'methods', false, array(
						'v1.0' => array(
								'user_details',
								'user_friends',
								'user_authenticate'
						)
				));
		}
		/**
		 * Make sure the key is valid when someone request for API 
		 * This will make sure not all users can access the API
		 *
		 * @return boolean
		 */
		public function validRequest() {
				$request = input('api_key_token');
				if($request == \ossn_services_apikey()) {
						return true;
				}
				return false;
		}
		/**
		 * Default API params 
		 * This will add some default api parameters.
		 *
		 * @return array
		 */
		public function defaultHeaders() {
				return array(
						'merchant' => \ossn_site_settings('site_name'),
						'url' => ossn_site_url(input('api_method')),
						'time_token' => time(),
						'payload' => false
						
				);
		}
		/**
		 * Display the response 
		 * This will output JSON formatted response
		 *
		 * @return void
		 */
		public function displayResponse(array $args = array()) {
				header('Content-type:application/json;charset=utf-8');
				$defaults = $this->defaultHeaders();
				echo json_encode(array_merge($defaults, $args), JSON_PRETTY_PRINT);
				exit;
		}
		/**
		 * Throw the custom API error
		 *
		 * @param string|integer $code A custom error code
		 * @param string  		 $message A error message
		 *
		 * @return array
		 */
		public function throwError($code = '', $message = '') {
				$this->displayResponse(array(
						'code' => $code,
						'message' => $message
				));
		}
		/**
		 * API success response
		 *
		 * @param string  $payload A data/message
		 *
		 * @return void
		 */
		public function successResponse($payload) {
				$this->displayResponse(array(
						'code' => '100',
						'message' => ossn_print('ossnservices:success'),
						'payload' => $payload
				));
		}
		/**
		 * This will set the users from OssnUser instance,  
		 * This will make sure no sensitive pass to the response
		 *
		 * @param object $user A OssnUser
		 *
		 * @return array
		 */
		public function setUser($user) {
				return (object) array(
						'first_name' => $user->first_name,
						'last_name' => $user->last_name,
						'email' => $user->email,
						'birthdate' => $user->birthdate,
						'gender' => $user->gender
				);
		}
		/**
		 * This will handle all the requests  
		 * Here we make sure the API is valid and the method exists in the system
		 * Each mehtod have a view called services/<api version>/<method name>
		 *
		 * @param array $requests A list of api arguments
		 *
		 * @return void
		 */
		public function handle($requests) {
				$version = $requests[0];
				$request = $requests[1];
				$methods = $this->getMethods();
				
				if(!isset($methods[$version]) || !ossn_services_apikey()) {
						$this->throwError('107', ossn_print('ossnservices:invalidversion'));
						
				}
				if((!isset($methods[$version]) && !in_array($request, $methods[$version])) || (isset($methods[$version]) && !in_array($request, $methods[$version]))) { 
						$this->throwError('101', ossn_print('ossnservices:invalidmethod'));
				}
				if(!$this->validRequest()) {
						$this->throwError('106', ossn_print('ossnservices:invalidkeytoken'));
				}
				$payload = ossn_plugin_view("services/{$version}/{$request}", array(
						'OssnServices' => $this
				));
				if(!empty($payload)) {
						echo $payload;
				} else {
						$this->throwError('102', ossn_print('ossnservices:noresponse'));
				}
		}
}
