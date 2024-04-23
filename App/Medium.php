<?php
namespace App;
class Medium{
    public function post(string $title, string $content, array $tags, string $canonicalUrl = '', string $cnt_format ='html'){
        $ch = curl_init();

        $url = 'https://api.medium.com/v1/users/'.MEDIUM_MY_USER_ID.'/posts';
        $authorization = 'Bearer '.MEDIUM_TOKEN;

        $data = array(
            "title" => $title,
            "contentFormat" => "html",
            "content" => "$content",
            "canonicalUrl" => "$canonicalUrl",
            "tags" => $tags,
            "publishStatus" => "public"
        );

        $headers = array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Accept-Charset: utf-8',
            'Authorization: '.$authorization
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);
        $obj = json_decode($response);
        $id = $obj->data->id ?? false;
        if($id) {
//            echo "Post publicado com sucesso!";
//            print_r($obj);
            return true;
        } else {
//            echo "Erro ao publicar o post: ";
//            if($obj){
//                print_r($obj);
//            }
            return false;
        }
    }

    public function getMyUserID($medium_token){
        $ch = curl_init();
        $url = 'https://api.medium.com/v1/me';
        $authorization = 'Bearer '.$medium_token;

        $headers = array(
            'Authorization: '.$authorization
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_encode(curl_exec($ch));
        curl_close($ch);
        $my_id = $response->data->id ?? false;
        if($my_id) {
           return $my_id;
        } else {
            if(!PRODUCTION){
                echo "Houve um erro";
                print_r($response);
            }
            return false;
        }
    }
}