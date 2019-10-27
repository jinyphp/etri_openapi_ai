<?php
require "../../../../vendor/autoload.php";
$accessKey = include "../../../../access_key.php";

// 음성인식
$obj = new \Etri\OpenAi\ASR\Recognition($accessKey);
$result = $obj->korean("KOR_M_RM0276MKDH0135.pcm")->execute();
// var_dump($result);
echo $result->return_object->recognized;

// 언어처리
$nlu = new \Etri\OpenAi\Text\NLU($accessKey);
$text = $result->return_object->recognized;
$result = $nlu->ner($text);
var_dump($result);