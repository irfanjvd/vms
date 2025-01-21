<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */
// ------------------------------------------------------------------------

/**
 * Element
 *
 * Lets you determine whether an array index is set and whether it has a value.
 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @return	mixed	depends on what the array contains
 */
if (!function_exists('session_to_page')) {

    function nadra_urdu_conversion($str) {
        $str_final = '';
//        $str="32,2f,20,46,2f,45";
        $str_len = explode(',', $str);

        foreach ($str_len as $character) {

            //$character = ord($str[$i]);
            //if (ListDigits.Contains(ch))
            //{
            //    continue;
            //}
            switch ($character) {
                case "20":
                    $str_final .= "&#x20";
                    //sb.append(" ");
                    break;

                case "22":
                    $str_final .= "&#x622";
                    //sb.append("&#x622");

                    break;

                case "27":
                    $str_final .= "&#x627";
                    //sb.append("&#x627");
                    break;

                case "13":
                    $str_final .="&#x613";
                    //sb.append("&#x613");
                    break;

                case "28":
                    $str_final .="&#x628";
                    //sb.append("&#x628");
                    break;

                case "2B":
                    $str_final .="&#x62b";
                    //sb.append("&#x62b");
                    break;

                case "86":
                    $str_final .="&#x686";
                    //sb.append("&#x686");
                    break;

                case "88":
                    $str_final .="&#x688";
                    //sb.append("&#x688");
                    break;

                case "2F":
                    $str_final .="&#x62f";
                    //sb.append("&#x62f");
                    break;

                case "10":
                    $str_final .="&#x610";
                    //sb.append("&#x610");
                    break;

                case "39":
                    $str_final .="&#x639";
                    //sb.append("&#x639");
                    break;

                case "41":
                    $str_final .="&#x641";
                    //sb.append("&#x641");
                    break;

                case "3A":
                    $str_final .="&#x63a";
                    //sb.append("&#x63a");
                    break;

                case "AF":
                    $str_final .="&#x6af";
                    //sb.append("&#x6af");
                    break;

                case "2D":
                    $str_final .="&#x62d";
                    //sb.append("&#x62d");
                    break;

                case "BE":
                    $str_final .="&#x6be";
                    //sb.append("&#x6be");
                    break;

                case "CC":
                    $str_final .="&#x6cc";
                    //sb.append("&#x6cc");
                    break;

                case "36":
                    $str_final .="&#x636";
                    //sb.append("&#x636");
                    break;

                case "2C":
                    $str_final .="&#x62c";
                    //sb.append("&#x62c");
                    break;

                case "2E":
                    $str_final .="&#x62e";
                    //sb.append("&#x62e");
                    break;

                case "43":
                    $str_final .="&#x643";
                    //sb.append("&#x643");
                    break;

                case "12":
                    $str_final .="&#x612";
                    //sb.append("&#x612");
                    break;

                case "44":
                    $str_final .="&#x644";
                    //sb.append("&#x644");
                    break;

                case "45":
                    $str_final .="&#x645";
                    //sb.append("&#x645");
                    break;

                case "BA":
                    $str_final .="&#x6ba";
                    //sb.append("&#x6ba");
                    break;

                case "46":
                    $str_final .="&#x646";
                    //sb.append("&#x646");
                    break;

                case "29":
                    $str_final .="&#x629";
                    //sb.append("&#x629");
                    break;

                case "A9":
                    $str_final .="&#x6a9";
                    //sb.append("&#x6a9");
                    break;

                case "C1":
                    $str_final .="&#x6c1";
                    //sb.append("&#x6c1");
                    break;

                //case "45":
                //    sb.Append("&#x645");
                //    break;

                case "7E":
                    $str_final .="&#x67e";
                    //sb.append("&#x67e");
                    break;

                case "42":
                    $str_final .="&#x642";
                    //sb.append("&#x642");
                    break;

                case "91":
                    $str_final .="&#x691";
                    //sb.append("&#x691");
                    break;

                case "31":
                    $str_final .="&#x631";
                    //sb.append("&#x631");
                    break;

                case "35":
                    $str_final .="&#x635";
                    //sb.append("&#x635");
                    break;

                case "33":
                    $str_final .="&#x633";
                    //sb.append("&#x633");
                    break;

                case "79":
                    $str_final .="&#x679";
                    //sb.append("&#x679");
                    break;

                case "2A":
                    $str_final .="&#x62a";
                    //sb.append("&#x62a");
                    break;

                case "21":
                    $str_final .="&#x621";
                    //sb.append("&#x621");
                    break;

                case "38":
                    $str_final .="&#x638";
                    //sb.append("&#x638");
                    break;

                case "37":
                    $str_final .="&#x637";
                    //sb.append("&#x637");
                    break;
//
//            case "48":
//                $str_final .= "\&#x635&#x644&#x649&#x627&#x644&#x644&#x647&#x639&#x644&#x64a&#x647&#x648&#x633&#x644&#x645";
//                //sb.Append("\&#x635&#x644&#x649\u0020&#x627&#x644&#x644&#x647\u0020&#x639&#x644&#x64a&#x647\u0020&#x648&#x633&#x644&#x645");
//                break;

                case "48":
                    $str_final .="&#x648";
                    //sb.append("&#x648");
                    break;

                case "98":
                    $str_final .="&#x698";
                    //sb.append("&#x698");
                    break;

                case "34":
                    $str_final .="&#x634";
                    //sb.append("&#x634");
                    break;

                case "D2":
                    $str_final .="&#x6d2";
                    //sb.append("&#x6d2");
                    break;

                case "30":
                    $str_final .="&#x630";
                    //sb.append("&#x630");
                    break;

                case "32":
                    $str_final .="&#x632";
                    //sb.append("&#x632");
                    break;

                case "60":
                    $str_final .="&#x660";
                    //sb.append("&#x660");
                    break;

                case "61":
                    $str_final .="&#x661";
                    //sb.append("&#x661");
                    break;

                case "62":
                    $str_final .="&#x662";
                    //sb.append("&#x662");
                    break;

                case "63":
                    $str_final .="&#x663";
                    //sb.append("&#x663");
                    break;

                case "64":
                    $str_final .="&#x664";
                    //sb.append("&#x664");
                    break;

                case "65":
                    $str_final .="&#x665";
                    //sb.append("&#x665");
                    break;

                case "66":
                    $str_final .="&#x666";
                    //sb.append("&#x666");
                    break;

                case "67":
                    $str_final .="&#x667";
                    //sb.append("&#x667");
                    break;

                case "68":
                    $str_final .="&#x668";
                    //sb.append("&#x668");
                    break;

                case "69":
                    $str_final .="&#x669";
                    //sb.append("&#x669");
                    break;

                case "0C":
                    $str_final .="&#x60c";
                    //sb.append(" \u200c");
                    break;

                case "D4":
                    $str_final .="&#x6d4";
                    //sb.append("&#x6d4");
                    break;

                case "0C":
                    $str_final .="&#x60c";
                    //sb.Append("&#x60c");
                    break;

                case "1F":
                    $str_final .="&#x61f";
                    //sb.append("&#x61f");
                    break;

                case "02":
                    $str_final .="&#x602";
                    //sb.append("&#x602");
                    break;

                case "1B":
                    $str_final .="&#x61b";
                    //sb.append("&#x61b");
                    break;

                case "7b":
                    $str_final .="&#x07b";
                    //sb.append("\u007b");
                    break;

                case "7D":
                    $str_final .="&#x07d";
                    //sb.append("\u007d");
                    break;
                case "cc":
                    $str_final .="&#x6cc";
                    //sb.append("\u007d");
                    break;
                case ($character == "e2"||$character == "80"||$character == "99"):
                    $str_final .="&#x6e2";
                    //sb.append("\u007d");
                    break;
                default:
                    $str_final .="&#x6" . $character;
                    break;
            }
        }

        return $str_final;
    }

}

function str_to_hex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
        //echo $string[$i].'='.ord($string[$i]).'='.dechex(ord($string[$i])).'<br />';
    }
    return $hex;
}

function send_sms($mobile_no,$message){
    $post_data=array(
        'sec_key'=>'451319be9caefc0904db10a735ab0708',
        'sms_text'=>$message,
        'phone_no'=>$mobile_no,
        'sms_language'=>'english'
    );
    $url="https://smsgateway.pitb.gov.pk/api/send_sms";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $return_data = curl_exec($ch);
    if(curl_errno($ch)){
        echo 'Request Error:' . curl_error($ch);die;
    }
    curl_close ($ch);
}


function sessiondata($session_index)
{
    $_ci =& get_instance();

    $all_session_data = $_ci->session->userdata;
    $logged_in_data   = $all_session_data['logged_in'];

    return $logged_in_data[$session_index];

}

/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */
