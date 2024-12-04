<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions

require 'application/libraries/REST_Controller.php';

class Api extends REST_Controller{
	
	public function __construct(){
		 
		parent::__construct();
//		set_error_handler(array($this, 'errorHandler'));
//		register_shutdown_function(array($this,"shutdownHandler"));
		ini_set('memory_limit', '-1');
	}

	function index_get(){
		$date="4-4-2018";
		echo $new_date=date("m-d-Y",strtotime($date));
		
	}
	/*API functions accepting GET requests*/

	function app_sync_get(){
		
		$imei_no = $this->get('imei_no');
		$mac_no = $this->get('mac_no');
		$app_version = $this->get('app_version');
		$version = $this->get('version');
		$this->load->model('api_model');
		if(isset($app_version) && $app_version!='') {
			//check app version....
			$version_result = $this->api_model->check_app_version($app_version);

			if ($version_result == false) {
				$apk_version_result=$this->get_apk_version_new();
				$this->response(array_merge($apk_version_result,array('status' => 'error', 'error_code' => '5', 'message' => 'Your application version is old.Kindly update the new version to proceed.')), 200);
			}else{
				$user_result=$this->get_user($imei_no,$mac_no);
				if($user_result['status']!="error") {
					$new_response['data']['user'] = $user_result;
					//get time for caontct, misceleanous, assets and roster...
					$new_response['data']['survey_time_limits']=$this->api_model->get_time();
					$structure_result = $this->get_structure($imei_no, $mac_no, $user_result['id'], $user_result['user_role_id'], $user_result['imei_mac'],$version);
					$apk_version_result=$this->get_apk_version_new();
					$new_response['data']['server_apk_version']=$apk_version_result;
					$new_response['data']['structure'] = $structure_result;
					//get exemption data for this supervisor...
					$exemption_result=$this->api_model->get_exemption($user_result['id']);
					$new_response['data']['exemptions'] = $exemption_result;
					$new_response['status'] = "Success";
					$new_response['message'] = "Synced Successfully !!!";
				}else{
					$apk_version_result=$this->get_apk_version_new();
					$this->response(array_merge($apk_version_result,$user_result), 200);
				}
				$this->response($new_response, 200);

			}
		}
	}


	//function is called from mobile api to save a private visit...
	public function save_post(){
		
		ob_start();	
		$data_string=$_REQUEST['data'];
		//$data_string=$this->post('json_data');
		
		if($data_string){
			$visit_result=json_decode($data_string,true);
			$visit_array=array(
						'title'=>$visit_result['title'],
						'agenda'=>$visit_result['agenda'],
						'tenant_id'=>$visit_result['tenant_id'],
						'employee_id'=>$visit_result['employee_id'],
						'user_id'=>$visit_result['user_id'],
						'visit_from'=>$visit_result['sent_by'],
						'is_cargo'=>$visit_result['is_cargo']
						);
			//echo "<pre>";
			//print_r($visit_array);die; 
			$members_array=$visit_result['visitors'];
			$this->load->model('common_model'); 
			$visit_code=$this->generateRandomNumber();
			$visit_array['visit_code']=$visit_code;
			// save visit...
			$visit_id=$this->common_model->save('private_visits',$visit_array);	
			
			//add visit id with members...
			foreach($members_array as $key=>$val){
				$val['private_visit_id']=$visit_id;
				$members_array[$key]=$val;
				$members_array[$key]['date_from']=date("Y-m-d",strtotime($val['date_from']));
				$members_array[$key]['date_to']=date("Y-m-d",strtotime($val['date_to']));
				
			}
			$this->common_model->save_bulk('private_members',$members_array);
			//add notification...
			$this->common_model->add_one('notifications','total',1);
			
			$this->response(array('status' => 'success', 'error_code' => '0', 'message' => 'Visit has been Submitted successfully'), 200);
		}
	}

	function generateRandomNumber($length =null) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    }
	
	//this function is being used to save tenant and tenant employees from astp app
	public function tenent_data_post(){
		$this->load->model('api_model');
		$id='';
		$table=$this->input->post('Table');
		$action=$this->input->post('Action');
		$key=$this->input->post('Key');
		if(isset($key) AND $key=="ASTP@pitb#123"){
			$data=json_decode($this->input->post('Data'),true);
			if($action=="EDIT"){
				if($table=="tenant"){
					$id=$this->input->post('Id');
					$where=array('id'=>$id);
					if($this->api_model->update($table,$where,$data)){
						$this->response(array('status' => 'success', 'error_code' => '0', 'message' => 'Tenant Updated Successfully !!!'), 200);
					}
				}
				if($table=="tenant_employees"){
					$employee_id=$this->input->post('Employee_id');
					$where=array('employee_id'=>$employee_id);
					if($this->api_model->update($table,$where,$data)){
						$this->response(array('status' => 'success', 'error_code' => '0', 'message' => 'Tenant Employee Updated Successfully !!!'), 200);
					}
					
				}
				
			}else if($action=="ADD"){
				if($this->api_model->save($table,$data)){
					$this->response(array('status' => 'success', 'error_code' => '0', 'message' => 'Record Added Successfully !!!'), 200);
				}
			}	
		}else{
			$this->response(array('status' => 'error', 'error_code' => '101', 'message' => 'Invalid key'), 200);
		}
	}
	
	public function get_tenant_info_get($id){
		$this->load->model('api_model');
		$tenant_info=$this->api_model->tenant_info($id);	
		$tenant_employee_info=$this->api_model->tenant_employee_info($id);	
		$return_arr=array('tenant'=>$tenant_info,'tenant_employees'=>$tenant_employee_info);
		$this->response(array('status' => 'success','data'=>$return_arr ,'error_code' => '0', 'message' => 'Data sent successfully'), 200);
		//echo json_encode($return_arr);
		
		
	}
	
	public function get_tenant_post(){
			$URL = "http://astp.punjab.gov.pk/WebService/TenantEmployeeService.asmx/Get_Tenant_Details";
			$query_string = array('key' => 'astp54000tenant');
			$result = $this->curlPost($URL, $query_string);
			print_r($result);
	}
	
	//this is called from mobile app to get private visits list...
	public function get_visits_post(){
		$start=$this->input->post("start_date");
		$end=$this->input->post("end_date");
		$user_id=$this->input->post("user_id");
		$key=$this->input->post("key");
		if($key=="ASTP@pitb#123"){
			$result=$this->api_model->get_visits($start,$end,$user_id);	
			if(empty($result)){
				$this->response(array('status' => 'success', 'error_code' => '0', 'message' => 'No data found!!!','data'=>''), 200);
			}else{
				$this->response(array('status' => 'success', 'error_code' => '0', 'message' => 'No data found!!!','data'=>$result), 200);
			}
		}else{
			$this->response(array('status' => 'error', 'error_code' => '101', 'message' => 'Invalid key'), 200);
		}	
	}


//New mobile app apis..

	function login_post(){
		header('Content-Type: application/json');
		$POSTdata = file_get_contents('php://input');
		$data=json_decode($POSTdata,true);
		if($data['username']!='' && $data['sec_key']=="astpvmsjs#*&123"){
			$user_name=$data['username'];
			$password=$data['password'];
			$url="https://astp.punjab.gov.pk/WebService/TenantEmployeeService.asmx/Get_Tenant_Login?Tenant_User_Name=$user_name&Tenant_Password=$password&Key=astp54000tenant";
			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			
	        $return_data = curl_exec($ch);
	        
	        if(curl_errno($ch)){
				echo 'Request Error:' . curl_error($ch);die;
			}
			curl_close ($ch);
			
			$xml=simplexml_load_string($return_data);
			$result = json_decode($xml[0],TRUE);
	        
	        if($result[0]['Status']==1){
				$tenant_id=$result[0]['Tenant_ID'];
				$user_id=$result[0]['User_ID'];
	            //get otp for this user
	            $otp_code=$this->generateOTP($user_id);
				//get tenant info...
				$tenant_result=$this->tenant_model->get_tenant($tenant_id);
	            $tenant_employee_result=$this->common_model->find("tenant_employees","employee_name",1,array('user_id'=>$result[0]['User_ID']));
				$sess_array = array(
					'status'=>'success',
	                'login_user_id' => $result[0]['User_ID'],
	                'login_tenant_id' => $result[0]['Tenant_ID'],
	                'login_tenant_name'=>$tenant_result['tenant_name'],
	                'login_user_fullname' => $tenant_employee_result['employee_name'],
	                'login_username' => $user_name,
	                'otp_code'=>$otp_code,
					'otp_required'=>0,
	                'login_user_type' => "TENANT",
	            );
				
				//find tenant info already saved or not???
				$tenant_info_result=$this->common_model->find("t_info",'column1',1,array('column1'=>$user_name));	
				if(!empty($tenant_info_result)){
					//update tenant info...
					$this->common_model->update("t_info",array('column1'=>$user_name,'column2'=>$password),array('column1'=>$user_name));
				}else{
					//save tenant login info....
					$this->common_model->save("t_info",array('column1'=>$user_name,'column2'=>$password));	
				}
	            echo json_encode($sess_array);
	            
			}else{
				$response=array(
					'status'=>'error',
					'message'=>'Invalid username or password'
				);
				echo  json_encode($response);
			}
		}else{
			$response=array(
				'status'=>'error',
				'messagae'=>'Invalid Key'
			);
			echo json_encode($response);
		}
	}
	
	function sync_post(){
		header('Content-Type: application/json');
		$POSTdata = file_get_contents('php://input');
		$data=json_decode($POSTdata,true);
		if($data['sec_key']=="astpvmsjs#*&123"){			
			//find tenant info already saved or not???
			$tenants=$this->common_model->find("tenant",'*',false);	
			$tenant_employees=$this->common_model->find("tenant_employees",'*',false);	
			$response=array(
				'status'=>'success',
				'tenants'=>$tenants,
				'employees'=>$tenant_employees
			);
			echo json_encode($response);
		}else{
			$response=array(
				'status'=>'error',
				'messagae'=>'Invalid Key'
			);
			echo json_encode($response);
		}
	}
	
	
	public function user_visits_post(){
		ob_start();	
		
		header('Content-Type: application/json');
		$POSTdata = file_get_contents('php://input');
		$data=json_decode($POSTdata,true);
		
		if($data['sec_key']=="astpvmsjs#*&123"){
			if($data){
				$user_id=$data['user_id'];
				$private_visits=$this->common_model->find("private_visits",'*',false,array('user_id'=>$user_id));
				$user_visits=array();
				if(!empty($private_visits)){
					foreach($private_visits as $key=>$val){
						$visit_id=$val['id'];
						$private_members=$this->common_model->find("private_members",'*',false,array('private_visit_id'=>$visit_id));
						if(!$private_members){
							$private_members=[];
						}
						$user_visits[]=array('visit_info'=>$val,'visit_members'=>$private_members);
						
					}
				}
				
				$this->response(array('status' => 'success', 'error_code' => '0', 'data' => $user_visits), 200);
			}
			
		}else{
			$response=array(
				'status'=>'error',
				'messagae'=>'Invalid Key'
			);
			echo json_encode($response);	
		}
			
	}
	
	public function save_visit_post(){
		ob_start();	
		
		header('Content-Type: application/json');
		$POSTdata = file_get_contents('php://input');
		$data=json_decode($POSTdata,true);
		
		if($data['sec_key']=="astpvmsjs#*&123"){
			if($data){
				$visit=$data['visit'];
				
				$visit_array=array(
					'title'=>$visit['title'],
					'agenda'=>$visit['agenda'],
					'tenant_id'=>$visit['tenant_id'],
					'employee_id'=>$visit['employee_id'],
					'user_id'=>$visit['user_id'],
					'visit_from'=>$visit['sent_by'],
					'is_cargo'=>$visit['is_cargo'],
				);
				$members_array=$data['visitors'];
				$this->load->model('common_model'); 
				
				$visit_code=$this->generateRandomNumber(7);
				$visit_array['visit_code']=$visit_code;
				// save visit...
				$visit_id=$this->common_model->save('private_visits',$visit_array);	
				
				//add visit id with members...
				foreach($members_array as $key=>$val){
					$val['private_visit_id']=$visit_id;
					$members_array[$key]=$val;
					$members_array[$key]['date_from']=date("Y-m-d",strtotime($val['date_from']));
					$members_array[$key]['date_to']=date("Y-m-d",strtotime($val['date_to']));
					
				}
				$this->common_model->save_bulk('private_members',$members_array);
				//add notification...
				$this->common_model->add_one('notifications','total',1);
				$this->response(array('status' => 'success', 'error_code' => '0', 'message' => 'Visit has been Submitted successfully'), 200);
			}
			
		}else{
			$response=array(
				'status'=>'error',
				'messagae'=>'Invalid Key'
			);
			echo json_encode($response);	
		}
			
	}
	
	

	function generateOTP($user_id){
        //generate a random string for OTP...
        $otp_code=$this->generateRandomString(5);
        // $post_data=array(
        //     'sec_key'=>'451319be9caefc0904db10a735ab0708',
        //     'sms_text'=>"VMS OTP Code is $otp_code",
        //     'phone_no'=>'03454094853',
        //     'sms_language'=>'english'
        // );
        // $url="https://smsgateway.pitb.gov.pk/api/send_sms";
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // $return_data = curl_exec($ch);
        // if(curl_errno($ch)){
        //     echo 'Request Error:' . curl_error($ch);die;
        // }
        // curl_close ($ch);
        
        $this->common_model->update("tenant_employees",array('otp_code'=>$otp_code,'otp_verified'=>0),array('user_id'=>$user_id));
        return $otp_code;
    }

    function generateRandomString($length =null) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }




}