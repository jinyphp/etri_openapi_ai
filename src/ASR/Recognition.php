<?php
/**
 * Etri OpenAI package
 * hojinlee(infohojin@naver.com)
 * https://github.com/jinyphp/etri_openapi_ai
 */
namespace Etri\OpenAi\ASR;

class Recognition
{
    const API_URL = "http://aiopen.etri.re.kr:8000/WiseASR/Recognition";

    private $Request;
    public function __construct($key)
    {
        $this->Request = new \Etri\OpenAi\ASR\Request($key);
        // echo __CLASS__;
    }

    // korean : 한국어 음성인식 코드
    public function korean($filename)
    {
        $this->Request->setArgument("korean",$filename);
        return $this;
    }

    // english: 영어 음성인식 코드
    public function english($filename)
    {
        $this->Request->setArgument("english",$filename);
        return $this;
    }

    // japanese: 일본어 음성인식 코드
    public function japanese($filename)
    {
        $this->Request->setArgument("japanese",$filename);
        return $this;
    }

    // chinese: 중국어 음성인식 코드
    public function chinese($filename)
    {
        $this->Request->setArgument("chinese",$filename);
        return $this;
    }

    // spanish: 스페인어 음성인식 코드
    public function spanish($filename)
    {
        $this->Request->setArgument("spanish",$filename);
        return $this;
    }

    // french: 프랑스어 음성인식 코드
    public function french($filename)
    {
        $this->Request->setArgument("french",$filename);
        return $this;
    }

    // german: 독일어 음성인식 코드
    public function german($filename)
    {
        $this->Request->setArgument("german",$filename);
        return $this;
    }

    // russian: 러시아어 음성인식 코드
    public function russian($filename)
    {
        $this->Request->setArgument("russian",$filename);
        return $this;
    }

    public function setAudio($code, $filename)
    {
        $this->Request->setArgument($code,$filename);
        return $this;
    }

    
    private $result;
    public function execute($cache=true)
    {
        // return $this->curl($this->Request, self::API_URL);
        if($cache) {
            // 케쉬 확인
            $path = "../../../../cache";
            if( !is_dir($path)) mkdir($path);

            $path .= DIRECTORY_SEPARATOR."Etri";
            if( !is_dir($path)) mkdir($path);

            $path .= DIRECTORY_SEPARATOR."Asr";
            if( !is_dir($path)) mkdir($path);

            $hash = sha1($this->Request->argument["audio"]);

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
            ile_put_contents($path.DIRECTORY_SEPARATOR.$hash.".json",$result);
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