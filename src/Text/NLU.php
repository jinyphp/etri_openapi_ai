<?php
/**
 * Etri OpenAI package
 * hojinlee(infohojin@naver.com)
 * https://github.com/jinyphp/etri_openapi_ai
 */
namespace Etri\OpenAi\Text;

class NLU
{
    const API_URL = "http://aiopen.etri.re.kr:8000/WiseNLU";
    public $accesskey;

    private $Request;
    public function __construct($key)
    {
        $this->Request = new \Etri\OpenAi\Text\Request($key);
        $this->accesskey = $key;
    }

    /**
     * 요청할 분석 코드로서 요청할 수 있는 분석 요청은 아래와 같음
     */
    
    // 형태소 분석 : "morp"
    public function morp($text)
    {
        $this->Request->setArgument("morp", $text);
        return $this->excute();
    }

    // 어휘의미 분석 (동음이의어 분석) : "wsd"
    public function wsd($text)
    {
        $this->Request->setArgument("wsd", $text);
        return $this->excute();
    }

    // 어휘의미 분석 (다의어 분석) : "wsd_poly"
    public function wsdPoly($text)
    {
        $this->Request->setArgument("wsd_poly", $text);
        return $this->excute();
    }

    // 개체명 인식 : "ner"
    public function ner($text)
    {
        $this->Request->setArgument("ner", $text);        
        return $this->excute();
    }

    // 의존 구문 분석 : "dparse"
    public function dparse($text)
    {
        $this->Request->setArgument("dparse", $text);
        return $this->excute();
    }

    // 의미역 인식 : "srl"
    public function srl($text)
    {
        $this->Request->setArgument("srl", $text);
        return $this->excute();
    }

    private $result;
    private function excute($cache=true)
    {
        if($cache) {
            // 케쉬 확인
            $path = "../../../../cache";
            if( !is_dir($path)) mkdir($path);

            $path .= DIRECTORY_SEPARATOR."Etri";
            if( !is_dir($path)) mkdir($path);

            $path .= DIRECTORY_SEPARATOR."NLU";
            if( !is_dir($path)) mkdir($path);

            $hash = sha1($this->Request->argument["text"]);

            $path .= DIRECTORY_SEPARATOR.$hash[0].$hash[0];
            if( !is_dir($path)) mkdir($path);
             

            if(file_exists($path.DIRECTORY_SEPARATOR.$hash.".json")) {
                $json = file_get_contents($path.DIRECTORY_SEPARATOR.$hash.".json");
                $this->result = json_decode($json);
                return $this->result;
            } else {
                $result = $this->curl($this->Request, self::API_URL);
                file_put_contents($path.DIRECTORY_SEPARATOR.$hash.".json",$result);
                $this->result = json_decode($result);
                return $this->result;
            } 
        } else {
            // 비활성 캐쉬
            $result = $this->curl($this->Request, self::API_URL);
            file_put_contents($path.DIRECTORY_SEPARATOR.$hash.".json",$result);
            $this->result = json_decode($result);
            return $this->result;
        }               
    }

    private function curl($request, $url)
    {
        try {
            $server_output = "";
            $ch = curl_init();
            $header = array(
                "Content-Type:application/json; charset=UTF-8",
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode ( $request) );
        
            $server_output = curl_exec($ch);
            
            if($server_output === false) {
                echo "Error Number:".curl_errno($ch)."\n";
                echo "Error String:".curl_error($ch)."\n";
            }            
        
            curl_close($ch);
        } catch ( Exception $e ) {
            echo $e->getMessage ();
        }
        
        return $server_output;
    }

    /**
     * 
     */
}