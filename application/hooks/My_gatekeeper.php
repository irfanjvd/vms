<?php
@session_start();
if (!defined('BASEPATH')) exit('No direct script access allowed');
// require 'vendor/autoload.php';
require 'uaparser.php';
require 'geoip2.phar';
use GeoIp2\Database\Reader;
class My_gatekeeper {
 	
 	private $CI=null;
 	private $Cityreader=null;
 	private $Ispreader=null;
 	private $LogTableName="GATEKEEPER_USER_HITS";
 	private $RulesTableName="GATEKEEPER_BLOCK_RULES";

	public function __construct() {
		
		$this->Cityreader = new Reader(APPPATH.'/hooks/GeoIP2-City.mmdb');
		$this->Ispreader = new Reader(APPPATH.'/hooks/GeoIP2-ISP.mmdb');

	    $this->CI = &get_instance();
	    $this->CI->load->database();
	    $this->Gatekeeper();
	}

 



	private function checkLogTable(){
		try{
    		$query = "CREATE TABLE IF NOT EXISTS `".$this->LogTableName."` (
			    `id` int(11) unsigned NOT NULL auto_increment,
			    `ip` varchar(255) NOT NULL default '',
			    `user-agent` varchar(255) NOT NULL default '',
			    `refferer` text default '',
			    `urlhit` text default '',
			    `method` varchar(255) default '',
			    `browser_name` varchar(255) default '',
			    `browser_vers` varchar(255) default '',
			    `platfrm_name` varchar(255) default '',
			    `platfrm_vers` varchar(255) default '',
			    `rndreng_name` varchar(255) default '',
			    `rndreng_vers` varchar(255) default '',
			    `archtcr_name` varchar(255) default '',
			    `city` varchar(255) default '',
			    `country` varchar(255) default '',
			    `region` varchar(255) default '',
			    `postcode` varchar(255) default '',
			    `lat` varchar(255) default '',
			    `lng` varchar(255) default '',
			    `isp` varchar(255) default '',
			    `org` varchar(255) default '',
			    `requesttime` varchar(255) default '',
			    `accessGranted` boolean NOT NULL default '1',
			    `blockedCause` varchar(255) default '',
			    `userIdInSession` varchar(255) default '',
			    PRIMARY KEY  (`ID`)
			)";
    		$result=$this->CI->db->query($query);
    	} catch (Exception $error){
 		}
	}

	private function checkRuleTable(){
		try{
    		$query = "CREATE TABLE IF NOT EXISTS `".$this->RulesTableName."` (
			    `id` int(11) unsigned NOT NULL auto_increment,
			    `ruleType` ENUM('IP', 'CITY', 'COUNTRY', 'REGION', 'POSTCODE', 'BROWSER_NAME', 'METHOD','URLHit','ISP') DEFAULT 'IP',
			    `value` varchar(255) NOT NULL default '',
			    PRIMARY KEY  (`ID`)
			)";
    		$result=$this->CI->db->query($query);
    	} catch (Exception $error){
 		}
	}
	private function saveHit($data){
		$cols="(";
		$vals="(";
		$id=0;
		foreach($data as $k=>$v)
		{
			$cols.="`".$k."`,";
			$vals.="'".$v."',";
		}
		$cols=rtrim($cols,",");
		$vals=rtrim($vals,",");
		$cols.=")";
		$vals.=")";
		try{
    		$query = "INSERT INTO ".$this->LogTableName." ".$cols." VALUES".$vals;
    		$result=$this->CI->db->query($query);
    		$id=$this->CI->db->insert_id();
    	} catch (Exception $error){
    		$id=-1;
 		}
 		return $id;
	}


    private function Gatekeeper(){
    	$this->checkLogTable();
    	$this->checkRuleTable();
    }
    
    private function getUserIP()
	{
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = '0';

	    return $ipaddress;
	}

	private function strHolds($main, $data, $type)
	{
		if($data[strtolower($type)]=="")
		{
			return $data;
		}
		$chunks=explode(",", $main);
		foreach($chunks as $c)
		{
			if (strpos(strtolower($data[strtolower($type)]), strtolower($c)) !== false || strpos(strtolower($c),strtolower($data[strtolower($type)])) !== false) {
			    $data['accessGranted']=0;
			    $data['blockedCause']=$type;
				return $data;
			}
		}
		return $data;
	}

    /**
     * This function used to block the every request except allowed ip address
     */
    private function checkRules($data)
    {
    	$q="select * from ".$this->RulesTableName;
    	$r=$this->CI->db->query($q);
    	foreach($r->result_array() as $rule)
    	{
    		$type=$rule['ruleType'];
    		$values=$rule['value'];
    		if($type=="IP")
    		{
    			$ips=explode(",", $values);
    			foreach($ips as $ip)
    			{
    				if(strpos($ip, "x"))
    				{
    					$high_ip=str_replace("x", "255", $ip);
    					$low_ip=str_replace("x", "0", $ip);
    					if ($data['ip'] <= $high_ip && $low_ip <= $data['ip']) {
						  	$data['accessGranted']=0;
						  	$data['blockedCause']="IP Subnet";

    						return $data;
						}

    				}
    				if($data['ip']==$ip)
    				{
    					$data['accessGranted']=0;
    					$data['blockedCause']="IP Address";
    					return $data;
    				}
    			}
    		}
    		$data=$this->strHolds($values,$data,$type);

    	}

    	return $data;
    }
    function requestLogger(){
    	
		$u_ip=$this->getUserIP();
		
		$CR=null;
		$IR=null;

		try
		{
		
			$CR = $this->Cityreader->city($u_ip);
			$IR = $this->Ispreader->isp($u_ip);
		}
		catch(Exception $e)
		{
			// echo $e;
		}
		
		$data=array();
		$data['ip']=$u_ip;
		@$data['user-agent']=$_SERVER['HTTP_USER_AGENT'];
		@$data['refferer']=$_SERVER['HTTP_REFERER'];
		@$data['urlhit']=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		@$data['method']=$_SERVER['REQUEST_METHOD'];
		@$data['browser_name']=$GLOBALS['parsed_UA']['browser_name'];
		@$data['browser_vers']=$GLOBALS['parsed_UA']['browser_vers'];
		@$data['platfrm_name']=$GLOBALS['parsed_UA']['platfrm_name'];
		@$data['platfrm_vers']=$GLOBALS['parsed_UA']['platfrm_vers'];
		@$data['rndreng_name']=$GLOBALS['parsed_UA']['rndreng_name'];
		@$data['rndreng_vers']=$GLOBALS['parsed_UA']['rndreng_vers'];
		@$data['archtcr_name']=$GLOBALS['parsed_UA']['archtcr_name'];
		@$data['city']=$CR->city->name;
		@$data['country']=$CR->country->name;
		@$data['region']=$CR->mostSpecificSubdivision->name;
		@$data['postcode']=$CR->postal->code;
		@$data['lat']=$CR->location->latitude;
		@$data['lng']=$CR->location->longitude;
		@$data['isp']=$IR->isp;
		@$data['org']=$IR->organization;
		$data['requesttime']=date('Y-m-d H:i:s');
		$data['accessGranted']=1;
		@$data['userIdInSession']=$_SESSION['id'];	
		
		

		$data=$this->checkRules($data);

				
		$id=$this->saveHit($data);

		if(!$data['accessGranted'])
		{
			// echo "NOT ALLOWED";
			header('HTTP/1.0 403 Forbidden');
    		die('You are not allowed to access this file.');     
		}
		
		

    }




}
?>