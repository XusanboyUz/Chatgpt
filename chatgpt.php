<?php


function gpt($text){
        $apiKey = "your api key";
    $url = 'https://api.openai.com/v1/chat/completions';

$headers = array(
    "Authorization: Bearer {$apiKey}",
    "Content-Type: application/json"
);
    $messages = array();
    $messages[] = array("role" => "user", "content" => "$text");
    
    // Define data
    $data = array();
    $data["model"] = "gpt-3.5-turbo";
    $data["messages"] = $messages;
    $data["max_tokens"] = 100;
    
    // init curl
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        return 'null';
    } else {
        $data = json_decode($result)->choices[0]->message->content;
        if(strlen($data)>2){
            return $data;
        }else{
            return 'null';
        }
    }
    curl_close($curl);
}
