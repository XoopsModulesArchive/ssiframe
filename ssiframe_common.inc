<?php
define('SSIFRAME_TABLE', $xoopsDB->prefix('ssiframe'));

function ssiframe_get_info(){
    global $xoopsUser, $xoopsDB;
    $retdata = [];
    if(!$result = $xoopsDB->query('select * from ' .SSIFRAME_TABLE )){
	$retdata['status'] = 'NG';
	return $retdata;
    }

    [
        $retdata['protocol'],
        $retdata['servername'],
        $retdata['port'],
        $retdata['path'],
        $retdata['method'],
        $retdata['basic'],
        $retdata['basic_user'],
        $retdata['basic_pass'],
        $retdata['param']
    ] = $xoopsDB->fetchRow($result);

    return $retdata;
}


function ssiframe_edit_info($udata){
    global $xoopsUser, $xoopsDB;

    $editsql = 'update ' .SSIFRAME_TABLE. ' set ';
    $editsql .= ' protocol='.$udata['protocol'];
    $editsql .= ',servername="'.$udata['servername'];
    $editsql .= '",port='.$udata['port'];
    $editsql .= ',path="'.$udata['path'];
    $editsql .= '",method='.$udata['method'];
    $editsql .= ',basic="'.$udata['basic'];
    $editsql .= '",basic_user="'.$udata['basic_user'];
    $editsql .= '",basic_pass="'.$udata['basic_pass'];
    $editsql .= '",param="'.$udata['param'];
    $editsql .= '"';
    if(!$result = $xoopsDB->query($editsql)){
	return false;
    }

    return true;
}

function get_http()
{
 
    $set_data = ssiframe_get_info();

    if ($set_data['port']==0){
        if($set_data['protocol']==1){
            $set_data['port'] = 80;
        }else{
            $set_data['port'] = 443;
        }
    }

    if($set_data['protocol']==1){
        $address = $set_data['servername'];
    }else if($set_data['protocol']==2){
        $address = 'ssl://'.$set_data['servername'];
    }

    if($set_data['method'] == 1) {
        $method = 'GET';
        $param = $set_data['param'];
    }else if($set_data['method'] == 2) {
        $method = 'POST';
        $param = '';
    }

    $request  = $method . ' ';

    if(strlen($set_data['path']) == 0){
         $request .= '/';
    }else{
         $request .= $set_data['path'];
    }


    if (($set_data['method'] == 1) && (strlen($set_data['param']) > 0 )){
        $request .=$param;
    }
    $request .=" HTTP/1.0\r\n";

    $request .= 'Host: ' . $set_data['servername'] . "\r\n";
    $request .= "User-Agent: XOOPS/ssiframe\r\n";

    if($set_data['basic']==1){
        if (isset($set_data['basic_user']) && isset($set_data['basic_pass'])) {
            $request .= 'Authorization: Basic ' . base64_encode($set_data['basic_user'] . ':' . $set_data['basic_pass']) . "\r\n";
        }
    }

    if (($set_data['method'] == 2) && (strlen($set_data['param']) > 0 )){
        $request .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $request .= 'Content-Length: ' . strlen($set_data['param']) . "\r\n";
        $request .= "\r\n";
        $request .= $set_data['param'];
    } else {
        $request .= "\r\n";
    }

    $fp = fsockopen($address, $set_data['port']);

    if (!$fp) {
        print($address);
        print($set_data['port']);
        print(" connect error\n");
        return false;
    }

    fwrite($fp, $request);

    $response = '';
    while (!feof($fp)) {
        $response .= fgets($fp, 4096);
    }

    fclose($fp);

    $ret_data = split("\r\n\r\n", $response, 2);

    if(isset($ret_data[1])){
        print($ret_data[1]);
    }else{
        print($ret_data[0]);
    }

    return true;
}


