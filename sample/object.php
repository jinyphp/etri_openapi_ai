<?php
require "../../../../vendor/autoload.php";

$accessKey = include "../../../../access_key.php";
$obj = new \Etri\OpenAi\Object\Detection($accessKey);
$result = $obj->setFile("picture04.jpg")->execute();
var_dump($result);