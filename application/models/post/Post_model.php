<?php

/**
 * Class Post_model
 */
class Post_model extends MY_model {

	var $table = 'post';

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('America/New_York');
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
	 * @param $author
	 * @return array
	 */
	function getByauthor($author) {
		$where = array( 'author'=>$author );
		return $this->_where($where);
	}

	/**
	 * @param $title
	 * @param $content
	 * @param $author
	 * @param $comments
	 * @return int
	 */
	function add($title="", $content="", $author="", $comments=0) {
		$insert = array(
			'title' => $title,
			'content' => $content,
			'author' => $author,
			'comments' => $comments,
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

	function addComment($id,$comments){
		$where = array('id'=>$id);
		$update = array(
			'comments' => $comments,
			'updated' => date('Y-m-d H:i:s'),
		);
		return $this->_update($where, $update);
	}
}