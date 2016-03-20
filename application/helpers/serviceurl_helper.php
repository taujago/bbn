<?php
if ( ! function_exists('service_url'))
{
	function service_url($arr = '')
	{
		$url_string = '';
		$CI =& get_instance();
		$url_service = $CI->config->item('service_url');
		if($arr == '') {
			return $url_service;
		}
		else {
			foreach($arr as $index =>$val) : 
			$val = urlencode($val);
			$url_string .= "$index=$val&";
			endforeach;
			return $url_service."?".$url_string; 
		}
		//eturn $CI->config->site_url($CI->uri->uri_string());
	}
}

if ( ! function_exists('xml_to_array'))
{

function xml_to_array($xml,$main_heading = '') {
	/*echo $xml;
	exit;*/
    $deXml = simplexml_load_string($xml);
    $deJson = json_encode($deXml);
    $xml_array = json_decode($deJson,TRUE);
    if (! empty($main_heading)) {
        $returned = $xml_array[$main_heading];
        return $returned;
    } else {
        return $xml_array;
    }
}


}


function xml_to_json($xml) {
	$deXml = simplexml_load_string($xml);
    $deJson = json_encode($deXml);
	return $deJson;
}


function show_array($arr) {
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}


function clear_array($arr) {
	$ret  = array();
	foreach($arr  as $index => $val) : 
		if(is_array($val)) {
			$ret[$index] = '';
		}
		else {
			$ret[$index] = $val;
		}
	endforeach; 
	return $ret;
}

function flipdate($date){
	$r=explode("-",$date);
	if(count($r) < 3){
		return "";
	}
	else {
		return $r[2]."-".$r[1]."-".$r[0];
	}
}
	
?>