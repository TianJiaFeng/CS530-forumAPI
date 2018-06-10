<?php

/**
 * Class PostComments_model
 */
class PostComments_model extends MY_model {

	var $table = 'postcomments';

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('America/New_York');
	}

	/**
	 * @param $postID
	 * @return array
	 */
	function getBypostID($postID) {
		$where = array( 'postID'=>$postID );
		return $this->_where($where);
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
	function add($postID="",$author="", $content="") {

		$insert = array(
			'postID' => $postID,
			'author' => $author,
			'content' => $content,
			'like' => 0,
			'dislike' => 0,
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
	 * @param $like
	 * @param $dislike
	 */
	function update($id,$like,$dislike){
		$where = array('id'=>$id);
		$update = array(
			'like' => $like,
			'dislike' => $dislike,
			'updated' => date('Y-m-d H:i:s'),
		);
		return $this->_update($where, $update);
	}
}