<?php
/**
 * Etri OpenAI package
 * hojinlee(infohojin@naver.com)
 * https://github.com/jinyphp/etri_openapi_ai
 */
namespace Etri\OpenAi\Text;

class Request
{
    public $access_key;
    public $argument=[];
    public function __construct($key)
    {
        $this->access_key = $key;
    }

    // 전달 인수 설정
    public function setArgument($code, $text)
    {
        $this->argument = array (
            "analysis_code" => $code,
            "text" => $text
        );
    }

    /**
     * 
     */
}