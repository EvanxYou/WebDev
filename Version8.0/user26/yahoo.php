<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://yh-finance.p.rapidapi.com/market/get-trending-tickers?region=US",
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

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response[0]["finance"]['result'][0]['startInterval'];
}