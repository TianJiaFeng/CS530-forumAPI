<?php
if (!defined('BASEPATH'))exit ('No direct script access allowed');

/**
 * Class Post
 */
class Post extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('post/Post_model');
		$this->load->model('post/PostComments_model');
	}

	function page() {

		$page = $this->input->post('page');
        $limit = $this->input->post('limit');

        $page = $page?intval($page):1;
        $limit = $limit?intval($limit):40;

        $result = $this->Post_model->_order_by(array('updated'=>'desc'))->pageCount($count,$page,$limit);
        $totalPage = ceil($count/$limit);
        foreach ($result as $r){
			$data[] = array(
				'id' => $r['id'],
				'title' => $r['title'],
				'content' => $r['content'],
				'author' => $r['author'],
				'comments' => $r['comments'],
				'updated' => date('H:i',strtotime($r['updated'])),
			);
		}
        if(is_array($data)){
            $response = array(
                'code' => '0',
                'msg' => 'Success',
                'totalPage' => $totalPage,
                'data' => $data,
            );
        }
        else {
            $response = array(
                'code' => '1',
                'msg' => 'Failed',
                'totalPage' => '1',
                'data' => 'error',
            );
        }
        $this->output->myOutput($response);
	}

	function detail() {

		$id = $this->input->post('id');
		$page = $this->input->post('page');
        $limit = $this->input->post('limit');

        $page = $page?intval($page):1;
        $limit = $limit?intval($limit):20;

        $result = $this->Post_model->getByID($id);
        $detail = $this->PostComments_model->_order_by(array('created'=>'asc'))->getBypostID($id)->pageCount($count,$page,$limit);
        $totalPage = ceil($count/$limit);
        foreach ($detail as $r){
        	$num = $r['like'] - $r['dislike'];
			$temp[] = array(
				'id' => $r['id'],
				'author' => $r['author'],
				'content' => $r['content'],
				'like' => $r['like'],
				'dislike' => $r['dislike'],
				'num' => $num,
				'created' => date('H:i',strtotime($r['created'])),
			);
		}
		$data = array(
			'author' => $result['author'],
			'title' => $result['title'],
			'content' => $result['content'],
			'commentsNumber' => $result['comments'],
			'created' => date('H:i',strtotime($result['created'])),
			'comments' => $temp,
		);
        $response = array(
            'code' => '0',
            'msg' => 'Success',
            'totalPage' => 1,
            'data' => $data,
        );
        $this->output->myOutput($response);
	}

	function delete() {

		$id = $this->input->post('id');
		if (!$id) {
			$response = array(
				'code' => '1',
				'msg' => 'insufficient info',
				'data' => array(),
			);
			$this->output->myOutput($response);
			return;
		}
		$result = $this->Post_model->del($id);
		$response = array(
			'code' => '0',
			'msg' => 'success',
			'data' => $result,
		);
		$this->output->myOutput($response);
	}

	function addPost() {
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$author = $this->input->post('author');
		if (!$title || !$content) {
			$response = array(
				'code' => '1',
				'msg' => 'insufficient info',
				'data' => array(),
			);
			$this->output->myOutput($response);
			return;
		}
		$result = $this->Post_model->add($title,$content,$author,0);
		if($result){
			$response = array(
				'code' => '0',
				'msg' => 'success',
				'data' => $result,
			);
		} else {
			$response = array(
				'code' => '1',
				'msg' => 'fail',
				'data' => array(),
			);
		}
		
		$this->output->myOutput($response);
	}

	function addComment() {
		$postID = $this->input->post('postID');
		$content = $this->input->post('content');
		$author = $this->input->post('author');
		$commentsNumber = $this->input->post('commentsNumber');
		if (!$content) {
			$response = array(
				'code' => '1',
				'msg' => 'insufficient info',
				'data' => array(),
			);
			$this->output->myOutput($response);
			return;
		}
		$result = $this->PostComments_model->add($postID,$author,$content,0);
		$this->Post_model->addComment($postID,$commentsNumber);
		if($result){
			$response = array(
				'code' => '0',
				'msg' => 'success',
				'data' => $result,
			);
		} else {
			$response = array(
				'code' => '1',
				'msg' => 'fail',
				'data' => array(),
			);
		}
		
		$this->output->myOutput($response);
	}

	function like() {
		$commentID = $this->input->post('commentID');
		$like = $this->input->post('like');
		$dislike = $this->input->post('dislike');
		if (!$commentID) {
			$response = array(
				'code' => '1',
				'msg' => 'insufficient info',
				'data' => array(),
			);
			$this->output->myOutput($response);
			return;
		}
		$result = $this->PostComments_model->update($commentID,$like,$dislike);
		$response = array(
			'code' => '0',
			'msg' => 'success',
			'data' => $result,
		);
		$this->output->myOutput($response);
	}

	function getHistoryPost() {
		$userName = $this->input->post('userName');
		$page = $this->input->post('page');
        $limit = $this->input->post('limit');

        $page = $page?intval($page):1;
        $limit = $limit?intval($limit):20;
        $result = $this->Post_model->_order_by(array('created'=>'desc'))->getByauthor($userName)->pageCount($count,$page,$limit);
        $totalPage = ceil($count/$limit);
        foreach ($result as $r){
			$data[] = array(
				'id' => $r['id'],
				'title' => $r['title'],
				'content' => $r['content'],
				'author' => $r['author'],
				'comments' => $r['comments'],
				'created' => date('H:i',strtotime($r['created'])),
				'updated' => date('H:i',strtotime($r['updated'])),
			);
		}
		if(is_array($data)){
            $response = array(
                'code' => '0',
                'msg' => 'Success',
                'totalPage' => $totalPage,
                'data' => $data,
            );
        }
        else {
            $response = array(
                'code' => '1',
                'msg' => 'Failed',
                'totalPage' => '1',
                'data' => 'error',
            );
        }
        $this->output->myOutput($response);
	}

	function getHistoryComment() {
		$userName = $this->input->post('userName');
		$page = $this->input->post('page');
        $limit = $this->input->post('limit');

        $page = $page?intval($page):1;
        $limit = $limit?intval($limit):20;
        $result = $this->PostComments_model->_order_by(array('created'=>'desc'))->getByauthor($userName)->pageCount($count,$page,$limit);
        $totalPage = ceil($count/$limit);
        foreach ($result as $r){
        	$num = $r['like'] - $r['dislike'];
        	$postID = $r['postID'];
        	$post = $this->Post_model->getByID($postID);
			$data[] = array(
				'id' => $r['id'],
				'postID' => $postID,
				'title' => $post['title'],
				'author' => $post['author'],
				'content' => $r['content'],
				'num' => $num,
				'created' => date('H:i',strtotime($r['created'])),
			);
		}
		if(is_array($data)){
            $response = array(
                'code' => '0',
                'msg' => 'Success',
                'totalPage' => $totalPage,
                'data' => $data,
            );
        }
        else {
            $response = array(
                'code' => '1',
                'msg' => 'Failed',
                'totalPage' => '1',
                'data' => 'error',
            );
        }
        $this->output->myOutput($response);
	}
}