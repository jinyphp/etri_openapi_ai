<?php

namespace Etri\OpenAi;

class Request
{
    public $access_key;
    public $argument=[];
    public function __construct($key)
    {
        $this->access_key = $key;
    }

    public function setArgument($code, $text)
    {
        $this->argument = array (
            "analysis_code" => $code,
            "text" => $text
        );
    }
}