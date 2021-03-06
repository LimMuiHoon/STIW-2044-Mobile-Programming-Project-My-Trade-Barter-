<?php

$api_key = '48ec2b28-b82c-4641-a3af-0c6643d9bc36';
$host = 'https://billplz-staging.herokuapp.com/api/v3/bills';
$collection_id = 'sxeg1l1h';

$data = array(
          'collection_id' => $collection_id,
          'email' => 'limmuihoon25@email.com',
          'mobile' => '60167620397',
          'name' => "Lim Mui Hoon",
          'amount' => 2000, // RM20
		  'description' => 'Test Messages',
          'callback_url' => "http://yourwebsite.com/return_url",
          'redirect_url' => "http://google.com",
          'reference_1_label' => "Bank Code",
          'reference_1' => "TEST0021"
);

$process = curl_init($host );
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data) ); 

$return = curl_exec($process);
curl_close($process);

$bill = json_decode($return, true);

//echo "<pre>".print_r($bill, true)."</pre>";

header("Location: {$bill['url']}?auto_submit=true");