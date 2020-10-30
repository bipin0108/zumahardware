<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NotificationController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
	}

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
		$data['page'] = 'notification/notification';
		$this->load->view('admin/template',$data);
	}

	function push_notification($fcm_ids, $fcmMsg){

		define( 'API_ACCESS_KEY', "AIzaSyB0CWbwzgOhkGzLrO4uWY6azwvoeUA-W1A" );

		$fcmFields = array(
		'registration_ids' => $fcm_ids,
		'priority' => 'high',
		'data' => $fcmMsg
		);

		$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec( $ch );
		curl_close( $ch );
		//echo $result . "\n\n";
	}

	public function send_notification()
	{
		$this->adminmodel->CSRFVerify();
 		$this->form_validation->set_rules('message','Message','required'); 
 		$this->form_validation->set_rules('user_type[]','User Type','required'); 
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  		
			//Error
		}
		else
		{
			$user_type = $_REQUEST['user_type'];
			$result = $this->notificationmodel->get_selected_user($user_type);
			$total = count($result);
			
			$cnt = ceil ($total/800);
			$limit = 800;
			if($limit > $total){
			   $limit = $total;
			}
			$j=0;
			$t=0;
			for ($i=0;$i<$cnt;$i++){
				$gcmRegIds=array();
				for ($j=$t;$j<$limit;$j++){
					if(!empty($result[$j]['device_token'])){
					array_push($gcmRegIds, $result[$j]['device_token']);
					}
				}
				//print_r($gcmRegIds);die;
				$message = array(
				    "title"=>"Hello",
				    "body"=>$_REQUEST['message']
			    );
				$res = $this->push_notification($gcmRegIds, $message);
				$t = $t + 800;
				$limit = $limit + 800;
				if($limit > $total){
					$limit = $total;
				}
			}

			$data = array(
				'message'=> $_REQUEST['message'],
				'user_type' => implode(',', $_REQUEST['user_type']),
			);
			$check = $this->notificationmodel->add_notification($data);
			if($check)
			{
				$this->session->set_flashdata('success', 'Notification has been send Successfully..'.$res);
				redirect('admin/notification');	
			}
		}
		$data['page'] = 'notification/notification';
		$this->load->view('admin/template',$data);
	}
	//end
}

