<?php
function get_random_id(){
    $random = '';
    for ($i = 1; $i <= 8; $i++){
        $random.= mt_rand(0, 9);
    }
    return $random;
}

function validate_input($input,$strip_tags=false)
{
    global $config;
    $con = db_connect($config);

    if(get_magic_quotes_gpc())
    {
        if(ini_get('magic_quotes_sybase'))
        {
            $input = str_replace("''", "'", $input);
        }
        else
        {
            $input = stripslashes($input);
        }
    }

    if($strip_tags){
        $input = stripUnwantedTagsAndAttrs($input);
    }else{
        $input = strip_tags($input);
        $input = mysqli_real_escape_string($con,$input);
    }

    return $input;
}

function getLocationInfoByIp(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    $result  = array('country'=>'', 'city'=>'');
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    if($ip != "::1"){
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        if($ip_data && $ip_data->geoplugin_countryName != null){
            $result['countryCode'] = $ip_data->geoplugin_countryCode;
            $result['country'] = $ip_data->geoplugin_countryName;
            $result['city'] = $ip_data->geoplugin_city;
            $result['latitude'] = $ip_data->geoplugin_latitude;
            $result['longitude'] = $ip_data->geoplugin_longitude;
        }
    }
    else{
        $result['countryCode'] = "IN";
        $result['country'] = "India";
        $result['city'] = "Jodhpur";
        $result['latitude'] = "26.23894689999999";
        $result['longitude'] = "73.02430939999999";
    }

    return $result;
}

function timeAgo($timestamp){
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        $timemsg = $diff->y .' '. ($diff->y > 1?'YEARS':'YEAR');
    }
    else if($diff->m > 0){
        $timemsg = $diff->m .' '. ($diff->m > 1?'MONTHS':'MONTH');
    }
    else if($diff->d > 0){
        $timemsg = $diff->d .' '. ($diff->d > 1?'DAYS':'DAY');
    }
    else if($diff->h > 0){
        $timemsg = $diff->h .' '. ($diff->h > 1 ?'HOURS':'HOUR');
    }
    else if($diff->i > 0){
        $timemsg = $diff->i .' '. ($diff->i > 1?'MINUTES':'MINUTE');
    }
    else if($diff->s > 0){
        $timemsg = $diff->s .' '. ($diff->s > 1?'SECONDS':'SECONDS');
    }
    if($timemsg == "")
        $timemsg = 'JUST_NOW';
    else
        $timemsg = $timemsg.' '.'AGO';

    return $timemsg;
}

function encode_ip($server,$env)
{
    if( getenv('HTTP_X_FORWARDED_FOR') != '' )
    {
        $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );

        $entries = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
        reset($entries);
        while (list(, $entry) = each($entries))
        {
            $entry = trim($entry);
            if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
            {
                $private_ip = array('/^0\./', '/^127\.0\.0\.1/', '/^192\.168\..*/', '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', '/^10\..*/', '/^224\..*/', '/^240\..*/');
                $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

                if ($client_ip != $found_ip)
                {
                    $client_ip = $found_ip;
                    break;
                }
            }
        }
    }
    else
    {
        $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );
    }

    return $client_ip;
}