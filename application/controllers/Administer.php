<?php
if (!defined('BASEPATH'))exit ('No direct script access allowed');

/**
 * Class Administer
 */
class Administer extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('administer/Administer_model');
	}

	function page() {

		$page = $this->input->post('page');
        $limit = $this->input->post('limit');

        $page = $page?intval($page):1;
        $limit = $limit?intval($limit):20;

        $result = $this->Administer_model->_where_in(array('role'=>array('2','3')))->pageCount($count,$page,$limit);
        $totalPage = ceil($count/$limit);
        foreach ($result as $r){
			$data[] = array(
				'id' => $r['id'],
				'email' => $r['email'],
				'userName' => $r['userName'],
				'password' => $r['password'],
				'role' => $r['role'],
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
		$result = $this->Administer_model->getByID($id);
		if($result){
			$data = array(
				'id' => $result['id'],
				'email' => $result['email'],
				'userName' => $result['userName'],
				'password' => $result['password'],
				'role' => $result['role'],
				'introduce' => $result['introduce'],
			);
			$response = array(
	            'code' => '0',
	            'msg' => 'success',
	            'data' => $data,
	        );
		} else {
			$response = array(
	            'code' => '0',
	            'msg' => 'error',
	            'data' => array(),
	        );
		}
		$this->output->myOutput($response);
	}

	function getByuserName() {
		$userName = $this->input->post('userName');
		$result = $this->Administer_model->getByuserName($userName);
		if($result){
			$data = array(
				'id' => $result['id'],
				'userName' => $result['userName'],
				'email' => $result['email'],
				'password' => $result['password'],
				'introduce' => $result['introduce'],
				'role' => $result['role'],
			);
			$response = array(
	            'code' => '0',
	            'msg' => 'success',
	            'data' => $data,
	        );
		} else {
			$response = array(
	            'code' => '0',
	            'msg' => 'error',
	            'data' => array(),
	        );
		}
		$this->output->myOutput($response);
	}

	function verify() {

		$userName = $this->input->post('userName');
		$password = $this->input->post('password');
		if (!$userName || !$password) {
			$response = array(
				'code' => '1',
				'msg' => 'Please input your userName and password',
				'data' => array(),
			);
			$this->output->myOutput($response);
			return;
		}
		$result = $this->Administer_model->verify($userName,$password);
		if($result){
			$data[] = array(
				'id' => $result['id'],
				'userName' => $result['userName'],
				'role' => $result['role'],
			);
			$response = array(
				'code' => '0',
				'msg' => 'success',
				'data' => $data,
			);
		} else {
			$response = array(
				'code' => '1',
				'msg' => 'Invaild userName or password',
				'data' => array(),
			);
		}
		
		$this->output->myOutput($response);
	}

	function save() {

		$id = $this->input->post('id');
		$userName = $this->input->post('userName');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		$introduce = $this->input->post('introduce');
		if (!$userName || !$email || !$password) {
			$response = array(
				'code' => '1',
				'msg' => 'insufficient info',
				'data' => array(),
			);
			$this->output->myOutput($response);
			return;
		}
		if($id){
			//update
			$result = $this->Administer_model->update($id,$userName,$email,$password,$role,$introduce);
		} else {
			//add
			$search = $this->Administer_model->getByuserName($userName);
			if($search){
				$response = array(
					'code' => '1',
					'msg' => 'repeated userName',
					'data' => array(),
				);
				$this->output->myOutput($response);
				return;
			}
			$result = $this->Administer_model->addAccount($userName,$email,$password,$role,$introduce);
		}
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

	function deleteUser() {

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
		$result = $this->Administer_model->del($id);
		$response = array(
			'code' => '0',
			'msg' => 'success',
			'data' => $result,
		);
		$this->output->myOutput($response);
	}
}