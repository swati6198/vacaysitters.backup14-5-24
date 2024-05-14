<?php
function myTrim($content) {
    if(strlen($content)>400){
    
   $content=substr($content, 0, 400); 
}
  $content = preg_replace("/(?:^((\pZ)+|((?!\R)\pC)+)(?1)*)|((?1)$)|(?:((?2)+|(?3)+)(?=(?2)|(?3)))/um", "", $content);
  $content = preg_replace("/(\pZ+)|((?!\R)\pC)/u", " " , $content);
  $content = preg_replace("/(^\R+)|(\R+$)|(\R(?=\R{2}))/u", "", $content);
  $content = preg_replace("/ㅤ/u", "", $content);
  $content = htmlentities(trim($content));
  $content = preg_replace("/\'/u", "&#x27;", $content);
  $content = preg_replace("/\//u", "&#x2F;", $content);
  $content = preg_replace("/\\\/", "&#92;", $content);
  $content = preg_replace("/\(/", "&#40;", $content);
  $content = preg_replace("/\)/", "&#41;", $content);
  
  return $content;
}
function queryMysql($query)
 {
   global $connection;
   
   $result = $connection->query($query);
   
   if (!$result) die($connection->error);
   return $result;
 }

 function random_strings($length_of_string) 
{ 
  
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
} 

 function mainUrl()
 {
   
   $result = "https://vacaysitters.radarsofttech.in/";
   return $result;
 }
 
 function loopCount()
 {
   
    $loop_count = "5";
   return $loop_count;
 }

 function maxdist()
 {
   $max_count = "200";
   return $max_count;
 } 
 
 function sendSitterNotification($tokensList,$title,$body)
 {
     $data =  ["registration_ids" => array($tokensList),
        "notification" => ["title"=> $title, "body"=> $body, "smallPicture"=> "", "bigPicture"=>"", "sound"=>"default" ]];
        
      $data_string = json_encode($data);
        
                $headers = array
                (
                'Authorization: key=' . 'AAAAIM0v3WM:APA91bFdyyqcexqZIAR17BUaraJKOjWe_MhADpbnkCbWGrtb-1qolzPHy2DlDBQaMd3l2THUcKmrVpFUECcekSUKZWD21DliU2UtzV801yx9rG9FY_futRcpUZBUGuL6UbJI4-HcqqDj',
                'Content-Type: application/json'
                );
        
        $ch = curl_init();

        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
        curl_setopt( $ch,CURLOPT_CAINFO, __DIR__.'/cacert.pem');

        $result = curl_exec($ch);
       // echo $result;
    
        return true;
 }
 
  
 function sendUserNotification($tokensList,$title,$body)
 {
     $data =  ["registration_ids" => array($tokensList),
        "notification" => ["title"=> $title, "body"=> $body, "smallPicture"=> "", "bigPicture"=>"", "sound"=>"default" ]];
        
      $data_string = json_encode($data);
        
                $headers = array
                (
                'Authorization: key=' . 'AAAApXUhkmk:APA91bGPzfO-t8IH4eHiZaCaHF4jvBnBJrqsHRTx9aXtOr0exkMDdews5pjBS1fwT6hoQLsGZdimYbXilhcEpLJvXDsBzHwWT5g5TDfjTrUxevn8dRX2u8npXvJ4AyWT332s1EpiTXAs	',
                'Content-Type: application/json'
                );
        
        $ch = curl_init();

        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
        curl_setopt( $ch,CURLOPT_CAINFO, __DIR__.'/cacert.pem');

        $result = curl_exec($ch);
       // echo $result;
    
        return true;
 }
 
 
 function sendemail($email,$otp)
 {
     
    $authKey = '418498ArSr98ZfGC65fd58b1P1';
$email = $email;
$name = 'Night king';
$template_id= "global_otp";
$YOUR_REGISTERED_DOMAIN = "vacaysitters.radarsofttech.in";
$company_name = "Vacay Sitters";
$six_digit_random_number = random_int(100000, 999999);
$curl = curl_init();


$arr=array(
  CURLOPT_URL => 'https://control.msg91.com/api/v5/email/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "recipients": [
        {
            "to": [
                {
                    "email": "'.$email.'",
                    "name": "'.$six_digit_random_number.'"
                }
            ],
            "variables": {
                "company_name": "'.$company_name.'",
                "otp": '.$six_digit_random_number.'
            }
        }
    ],
    "from": {
        "email": "mailer91@'.$YOUR_REGISTERED_DOMAIN.'"
    },
    "domain": "mail.'.$YOUR_REGISTERED_DOMAIN.'",
    "template_id": "'.$template_id.'"
}',
  CURLOPT_HTTPHEADER => array(
    'authkey: '.$authKey,
    'Content-Type: application/json'
  ));

curl_setopt_array($curl, $arr);
curl_setopt($curl, CURLOPT_CAINFO, __DIR__.'/cacert.pem');
$response = curl_exec($curl);


$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

return $httpcode;





 }



?>