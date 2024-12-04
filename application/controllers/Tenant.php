<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenant extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

//    public function __construct()
//    {
//        parent::__construct();
//        $this->load->model('location_model');
//    }
    function get_tenant_employees(){
        $tenant=$_POST['tenant'];
        $tenant_employees=$this->tenant_model->get_employees($tenant);
        echo json_encode($tenant_employees);


    }

    function get_tenants_for_filter(){
        $result=$this->tenant_model->get_tenants_for_filter();
        $tenant_array=array();
        foreach($result as $key=>$val){
        	$tenant_array[]=array(
        		'value'=>$val['id'],
        		'label'=>$val['tenant_name']
        	);
        }
        echo json_encode($tenant_array);
    }
	
	function get_tenant_employees_for_filter(){
		$session_data=$this->session->userdata('logged_in');
		if($session_data['login_user_type']=="TENANT"){
			$tenant_id=$session_data['login_tenant_id'];	
		}else{
			$tenant_id='';
		}
		$value="value";
		$label="label";
        $result=$this->tenant_model->get_tenant_employees_for_filter($tenant_id);
		$return_arr=array();
        if(!empty($result)){
			foreach($result as $key=>$val){
				$return_arr[]=array($value=>$val['id'],$label=>$val['employee_name']);
			}
		}
		echo json_encode($return_arr);
    }
	
	function get_tenant_for_filter(){
		$session_data=$this->session->userdata('logged_in');
		if($session_data['login_user_type']=="TENANT"){
			$tenant_id=$session_data['login_tenant_id'];	
		}else{
			$tenant_id='';
		}
		$value="value";
		$label="label";
        $result=$this->tenant_model->get_tenant_for_private_visits($tenant_id);
		$return_arr=array();
        if(!empty($result)){
			foreach($result as $key=>$val){
				$return_arr[]=array($value=>$val['id'],$label=>$val['tenant_name']);
			}
		}
		echo json_encode($return_arr);
    }
	
	//this is used to save new tenant employees added by ASTP and are added in VMS here...
	function curl_post(){
		ini_set('max_execution_time', 300);
		//$URL = "http://astp.punjab.gov.pk/WebService/TenantEmployeeService.asmx/Get_Tenant_Details";
		$URL = "https://astp.punjab.gov.pk/WebService/TenantEmployeeService.asmx/Get_Tenant_Employee_Details";
		$query_string = array('key' => 'astp54000tenant');
		//$result = $this->curlPost($URL, $query_string);
		//print_r($result);
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_HEADER, array('X-API-KEY:','Username:hris-emp','Password:$2a$09$fq00cLhQ86MBe9ATUOWf7B6dz'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query_string));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		$result=  $server_output;
		
		
		$xml = simplexml_load_string($result);
		$result = json_decode($xml,TRUE);
		$i=1;
		$j=1;
		
		$new_tenant_employees=array();
		foreach($result as $key=>$val){
			$tenant_id=$val['Tenant_ID'];
			$tenant_name=$val['Tenant_Name'];
			$employee_name=$val['Emp_Name'];
			$father_name=$val['Emp_Father_Name'];
			$employee_id=(int)$val['Emp_ID'];
			$cnic=$val['Emp_CNIC_No'];
			$mobile=$val['Emp_Mobile_No'];
			$email=$val['Emp_Email'];
			$status=$val['Status_ID'];
			$user_id=$val['User_ID'];
			$designation=$val['Emp_Designation'];
			$this->common_model->update("tenant_employees",array('email'=>$email,'employee_id'=>$employee_id,'status'=>$status),array('mobile_no'=>$mobile,'employee_name' =>$employee_name));
			if($user_id!=null){
				$this->common_model->update("tenant_employees",array('user_id'=>$user_id),array('employee_id'=>$employee_id));
			}
			//check tenant id exist or not??
			$tenant=$this->tenant_model->get_tenant_employee($tenant_id,$employee_name);
			
			if(!empty($tenant)){
				//update emp id cnic and email status...
				/*$data=array('employee_id'=>$employee_id,'cnic'=>$cnic,'email'=>$email,'status'=>$status);
				$this->tenant_model->update_employee_info($tenant_id,$employee_name,$data);
				echo $i." = found<br>";
				$i++;*/
			}else{
				$new_tenant_employees[]=array(
										'tenant_id'=>$tenant_id,
										'tenant_name'=>$tenant_name,
										'employee_id'=>$employee_id,
										'user_id'=>$user_id,
										'employee_name'=>$employee_name,
										'father_name'=>$father_name,
										'email'=>$email,
										'cnic'=>$cnic,
										'mobile_no'=>$mobile,
										'status'=>$status,
										'designation'=>$designation
										);
			}
			
		}
		
		if(!empty($new_tenant_employees)){
			$this->tenant_model->save_tenants('tenant_employees',$new_tenant_employees);
		}
		echo "<pre>";
		print_r($new_tenant_employees);die;
		
		
		
	}
	
	//this is used to save new tenant added by ASTP and are added in VMS here...
	function curl_save_tenant_post(){
		$URL = "https://astp.punjab.gov.pk/WebService/TenantEmployeeService.asmx/Get_Tenant_Details";
		//$URL = "http://astp.punjab.gov.pk/WebService/TenantEmployeeService.asmx/Get_Tenant_Employee_Details";
		$query_string = array('key' => 'astp54000tenant');
		//$result = $this->curlPost($URL, $query_string);
		//print_r($result);
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query_string));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		$result=  $server_output;
		$xml = simplexml_load_string($result);
		$result = json_decode($xml,TRUE);
		$i=1;
		$j=1;
		
		$new_tenants=array();
		foreach($result as $key=>$val){
			$tenant_id=$val['Tenant_ID'];
			$tenant_name=$val['Tenant_Name'];
			$status=$val['Status_ID'];
			//check tenant id exist or not??
			$tenant=$this->tenant_model->get_tenant($tenant_id);
			if(!empty($tenant)){
				//update emp id , name and status...
				$status_data=array('status'=>$status);
				$this->tenant_model->update_tenant_info($tenant_id,$status_data);
			}else{
				$new_tenants[]=array(
										'id'=>$tenant_id,
										'tenant_name'=>$tenant_name,
										'status'=>$status,
										);
			}
			
		}
		
		if(!empty($new_tenants)){
			$this->tenant_model->save_tenants('tenant',$new_tenants);
		}
		echo "<pre>";
		print_r($new_tenants);die;
		
	}
	
	function changeDate(){
		ini_set('memory_limit', -1);
		ini_set('max_execution_time', '0');

		$all_visits=$this->common_model->find("private_members","id,date_from,date_to",false,"my_date_from is null");
		
		$my_dates=array();
		foreach($all_visits as $key=>$val){
			
			$data=array(
				'my_date_from'=>date("Y-m-d",strtotime($val['date_from'])),
				'my_date_to'=>date("Y-m-d",strtotime($val['date_to'])),
			);
			die("dddd");
			$this->common_model->update("private_members",$data,array('id'=>$val['id']));
		}
		echo "done";
		
	}

	function syncEmployee(){
		// $post_arr=array(
		// 	'sec_key'=>"ASTP*&34VMS",
		// 	'action'=>"CREATE/UPDATE",
		// 	'employee_id'=>"YOUR_EMPLOYEE_ID",
		// 	'employee'=>array(
		// 		'tenant_id'=>'Tenant_ID',
		// 		'tenant_name'=>'Tenant_Name',
		// 		'employee_id'=>'Emp_ID',
		// 		'employee_name'=>'Emp_Name',
		// 		'father_name'=>'Emp_Father_Name',
		// 		'cnic'=>'Emp_CNIC_No',
		// 		'mobile_no'=>'Emp_Mobile_No',
		// 		'email'=>'Emp_Email',
		// 		'designation'=>'Emp_Designation',
		// 		'status'=>'Status_ID',
				
		// 	),
		// );
		
		// foreach($post_arr as $rec_key => $rec_value)
		// {
		// 		if(is_array($rec_value) || is_object($rec_value))
		// 			echo $rec_key.":".json_encode($rec_value);
		// 		else	
		// 			echo $rec_key.":".$rec_value."<br />";
		// }

		$data=$_POST;
		if($data['sec_key']=="ASTP*&34VMS"){
			if($data['action']=="CREATE"){
				$employee_data=json_decode($data['employee'],true);
				$this->common_model->save("tenant_employees",$employee_data);	
				$response=array(
					'status'=>'success',
					'message'=>'Employee Created Successfully!!!'
				);
				echo json_encode($response);
			}else if($data['action']=="UPDATE"){
				$employee_data=json_decode($data['employee'],true);
				$employee_id=$data['employee_id'];
				$this->common_model->update("tenant_employees",$employee_data,array('employee_id'=>$employee_id));	
				$response=array(
					'status'=>'success',
					'message'=>'Employee Updated Successfully!!!'
				);
				echo json_encode($response);
			}else{
				$response=array(
					'status'=>'error',
					'message'=>'Please send proper action'
				);
				echo json_encode($response);
			}
			
		}else{
			$response=array(
				'status'=>'error',
				'message'=>'Invalid Security Key'
			);
			echo json_encode($response);
		}
	}

}
