<?php


function sendUserNotification($tokensList, $title, $body){
    
    
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
        echo $result;
    
        return true;
    
}

function sendSitterNotification($tokensList, $title, $body){
    
    
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
        echo $result;
    
        return true;
    
}

?>