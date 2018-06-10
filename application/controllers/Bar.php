<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bar extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	/**
	 * @api {post} Bar/getBar
	 * @apiName getBar
	 * @apiGroup Bar
	 */
	function getBar() {
		$menu[0] = array(
			'id' => 'user',
			'txt' => 'User',
			'link' => 'user.html',
		);

		$menu[1] = array(
			'id' => 'login',
			'txt' => 'Exit',
			'link' => 'login.html',
		);

		$response = array(
			'code' => '0',
			'msg' => '成功',
			'data' => $menu,
		);
		$this->output->myOutput($response);
	}

	/**
	 * @api {post} Bar/getBar
	 * @apiName getBar
	 * @apiGroup Bar
	 */
	function getAccountBar() {
		$menu[0] = array(
			'id' => 'account',
			'txt' => 'Account',
			'link' => 'account.html',
		);

		$menu[1] = array(
			'id' => 'history',
			'txt' => 'History',
			'link' => 'history.html',
		);

		$menu[2] = array(
			'id' => 'post',
			'txt' => 'Back',
			'link' => 'post.html',
		);

		$response = array(
			'code' => '0',
			'msg' => '成功',
			'data' => $menu,
		);
		$this->output->myOutput($response);
	}

}