<?php

require 'config.php';

$ip = get_ip_address();
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

$location = explode(",", $details->loc);
$latitude = $location[0];
$longitude = $location[1];

echo 'Current User: ' . '<br>';
echo 'Location: ' . $details->loc . '<br>';


$sql = "create table if not exists user(
                    id bigint(20) unsigned auto_increment primary key not null,
                    username varchar(20) not null,
                    location varchar(255) not null,
                    latitude decimal(10, 8) not null,
                    longitude decimal(11, 8) not null,
                    time datetime not null default '0000-00-00 00:00:00'
                )

                CHARACTER SET utf8, COLLATE utf8_general_ci ";

                $result = mysqli_query($conn,$sql);

                if($result){

                	$sql = "insert into user (username, location, latitude, longitude, time) values ('Ikomi Moses', '$details->loc', '$latitude', '$longitude', '$realtime')";
                    $result = mysqli_query($conn,$sql);

                    if($result){

                    	$count = mysqli_affected_rows($conn);

                        if($count > 0) {

                        	echo 'Inserted';
                        }
                    }
                }






function get_ip_address() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                // trim for safety measures
                $ip = trim($ip);
                // attempt to validate IP
                if (validate_ip($ip)) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function validate_ip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}



?>