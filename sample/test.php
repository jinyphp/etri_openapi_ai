<?php
// require "../../../../vendor/autoload.php";


$openApiURL = "http://aiopen.etri.re.kr:8000/WiseNLU";
$accessKey = "0dd87d06-985f-4281-b4c8-79f27c05034e";
$analysisCode = "ner";
$text = "윤동주는 한국의 독립운동가, 시인, 작가이다.";
 
$request = array(
    "access_key" => $accessKey,
    "argument" => array (
        "analysis_code" => $analysisCode,
        "text" => $text
    )
);
 
try {
    $server_output = "";
    $ch = curl_init();
    $header = array(
        "Content-Type:application/json; charset=UTF-8",
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_URL, $openApiURL);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode ( $request) );
 
    $server_output = curl_exec ($ch);
    if($server_output === false) {
        echo "Error Number:".curl_errno($ch)."\n";
        echo "Error String:".curl_error($ch)."\n";
    }
 
    curl_close ($ch);
} catch ( Exception $e ) {
    echo $e->getMessage ();
}
 
echo "result = " . var_dump($server_output);