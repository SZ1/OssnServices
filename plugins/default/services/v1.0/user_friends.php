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
$guid     = input('guid');
$username = input('username');
$email    = input('email');
if($guid) {
		$user = ossn_user_by_guid($guid);
}
if($username) {
		$user = ossn_user_by_username($username);
}
if($email) {
		$user = ossn_user_by_email($email);
}
if($user) {
		$count   = $user->getFriends($user->guid, array(
				'count' => true
		));
		$friends = $user->getFriends($user->guid, array(
				'page_limit' => true
		));
		if($friends) {
				foreach($friends as $item) {
						$user_friends[] = $params['OssnServices']->setUser($item);
				}
		}
		$params['OssnServices']->successResponse(array(
				'total' => $count,
				'friends' => $user_friends
		));
} else {
		$params['OssnServices']->throwError('103', ossn_print('ossnservices:nouser'));
}