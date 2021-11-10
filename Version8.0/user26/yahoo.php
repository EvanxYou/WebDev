<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://yh-finance.p.rapidapi.com/market/get-popular-watchlists",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: yh-finance.p.rapidapi.com",
		"x-rapidapi-key: 35e86d947cmshc1497a0c14f6db5p1b04f4jsnf57d3aea4396"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$data = json_decode($response,true);

 if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo 'test' . '<br>';
	echo $data['finance']['result'][0]['portfolios'][1]['symbolCount'];
	//echo $response;
	//print_r($response);
}
