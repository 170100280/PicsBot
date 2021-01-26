<?php

class AcaAmUtil{
    const BOT_SIGNATURE = "For educational tests only";
    public static function consumeUrl(
        $pUrl //can be an HTML page, can be a JPG, ...
    ){
        //$bValid = is_string($pUrl) && strlen($pUrl);
        $ch = curl_init($pUrl);
        if ($ch){
            //curl_setopt(CURLOPT_URL, $pUrl);
            /*
             * makes it explic that the request
             * will happen using HTTP GET
             */
            curl_setopt(
                $ch,
                CURLOPT_HTTPGET,
                true
            );

            /*
             * disables the verification of SSL
             * certificates
             * useful when not using cacert.pem
             */
            curl_setopt(
                $ch,
                CURLOPT_SSL_VERIFYPEER,
                true
            );

            /*
             * sets a user agent string for our
             * software
             */
            curl_setopt(
                $ch,
                CURLOPT_USERAGENT,
                self::BOT_SIGNATURE
            );

            //if set to true, curl_exec will return
            //the data consumed at the URL
            //instead of just true/false
            curl_setopt(
                $ch,
                CURLOPT_RETURNTRANSFER,
                true
            );

            /*
             * makes it clear that we want all the bytes
             */
            curl_setopt(
                $ch,
                CURLOPT_BINARYTRANSFER, //deprecated
                true
            );

            /*
             * sets automatic handling of the encoded
             * data
             */
            curl_setopt(
                $ch,
                CURLOPT_ENCODING,
                ""
            );

            $bin = curl_exec($ch);

            return $bin;
        }//if
        return false;
    }//consumeUrl


}