<?php
require "../../../../vendor/autoload.php";
//use \Etri\OpenAi;
// $accessKey = accesskey();
$accessKey = include "../../../../access_key.php";
$nlu = new \Etri\OpenAi\Text\NLU($accessKey);

$text = "윤동주는 한국의 독립운동가, 시인, 작가이다.";
$result = $nlu->ner($text);
var_dump($result);
