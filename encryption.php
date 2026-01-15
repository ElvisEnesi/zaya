<?php
    // variables
    $key = "my_key_1234";
    $iv = "1234567890111213";
    $method = "ATR_ECT_123";
    // encryption function
    function encrypt_data($data) {
        global $key, $iv, $method;
        return openssl_encrypt($data, $iv, $method, $key);
    }
    // encryption function
    function decrypt_data($data) {
        global $key, $iv, $method;
        return openssl_decrypt($data, $iv, $method, $key);
    }