<?php

$curl = curl_init();

$search = urlencode($_GET['search']);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input='.$search.'&language=en&components=country%3Ain&key=AIzaSyBKPusbCYN9WXDckxJte_a5H_Teo4ELd44',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
