<?php

/**
 * Class Administer_model
 */
class Administer_model extends MY_model {

	var $table = 'administer';

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('America/New_York');
	}

	/**
	 * @param $userName
	 * @return array
	 */
	function getByuserName($userName) {
		$where = array( 'userName'=>$userName );
		$arr = $this->_where($where)->_limit(1)->_select();
		if ($arr) {
			return $arr[0];
		} else {
			return array();
		}
	}

	/**
	 * @param $id
	 * @return array
	 */
	function getByID($id) {
		$where = array( 'id'=>$id );
		$arr = $this->_where($where)->_limit(1)->_select();
		if ($arr) {
			return $arr[0];
		} else {
			return array();
		}
	}

	/**
	 * @param $userName
	 * @param $email
	 * @param $password
	 * @param $role
	 * @return int
	 */
	function addAccount($userName="", $email="", $password="", $role=0, $introduce="") {
		$insert = array(
			'email' => $email,
			'userName' => $userName,
			'password' => $password,
			'role' => $role,
			'introduce' => $introduce,
			'created' => date('Y-m-d H:i:s'),
			'updated' => date('Y-m-d H:i:s'),
		);
		return $this->_insert($insert);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	function del($id) {
		$where  = array( 'id'=>$id );
		return $this->_delete($where);
	}


	/**
	 * @param $id
	 * @param $userName
	 * @param $email
	 * @param $password
	 * @param $role
	 */
	function update($id,$userName,$email,$password,$role,$introduce){
		$where = array('id'=>$id);
		$update = array(
			'userName' => $userName,
			'email' => $email,
			'password' => $password,
			'role' => $role,
			'introduce' => $introduce,
			'updated' => date('Y-m-d H:i:s'),
		);
		return $this->_update($where, $update);
	}
	
	/**
	 * @param $userName
	 * @param $password
	 * @return $this
	 */
	function verify($userName="", $password=""){
		$where = array( 
			'userName'=>$userName,
			'password'=>$password, 
		);
		$arr = $this->_where($where)->_limit(1)->_select();
		if ($arr) {
			return $arr[0];
		} else {
			return array();
		}
	}
}