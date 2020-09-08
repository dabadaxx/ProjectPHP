<?php

class RestClient {

    static function call($method, $callData = array())  {

        //state the request header
        $requestHeader = array('requesttype' => $method);

        //Options for our stream.
        $options = array(
                'http' => array(
                    'header' => 'Content-Type: application/json',
                    'method' => $method,
                    'content' => json_encode($callData)
                )
            );
        $context = stream_context_create($options);
        $result = file_get_contents(API_URL, false, $context);


        return json_decode($result);

    }
}