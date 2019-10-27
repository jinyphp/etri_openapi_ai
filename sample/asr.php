<?php
require "../../../../vendor/autoload.php";

$accessKey = include "../../../../access_key.php";
$obj = new \Etri\OpenAi\ASR\Recognition($accessKey);
$result = $obj->korean("KOR_M_RM0276MKDH0135.pcm")->execute();
var_dump($result);