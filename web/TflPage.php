<?php

class TflPage {

    public function work($password, $url = "http://localhost:8080/tflrefundservice/history") {

        $data = array("password" => $password);
        $url .= '?'.http_build_query($data);

        $curl = curl_init($url);
        
        //curl_setopt($curl, CURLOPT_TIMEOUT_MS, $this->timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->verify_certificate);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);

        $response = curl_exec($curl);

        if (!$response) {
            $errorNumber  = curl_errno($curl);
            $errorMessage = curl_error($curl);

            curl_close($curl);

            if ($errorNumber == CURLE_OPERATION_TIMEOUTED) {
                $message = "Request to url: $url timed out: $errorMessage";
                echo($message);
                throw new \Exception($message);
            }

            $message = "Request to url: $url failed. $errorMessage";
            echo($message);
            throw new \Exception($message);
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);;

        curl_close($curl);
echo($response);
        return json_decode($response);
    }

}