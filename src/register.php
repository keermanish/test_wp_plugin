<?php

function post_data(
    string $domain,
    string $customer_id,
    string $patrner_id,
    string $plugin_name,
    string $wp_dir
) {
    // load wp functions
    require_once "$wp_dir/wp-load.php";

    echo "passed information $domain, $customer_id, $patrner_id \n";

    $payload = json_encode([
        "domain" => $domain,
        "customer_id" => $customer_id,
        "patrner_id" => $patrner_id
    ]);

    // Prepare new cURL resource
    $crl = curl_init("http://localhost:3001/my_post_api");
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLOPT_FAILONERROR, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $payload);

    // Set HTTP Header for POST request
    curl_setopt($crl, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Content-Length: " . strlen($payload)
    ]);

    // Submit the POST request
    $result = curl_exec($crl);

    echo "result $result \n";

    // handle curl error
    if ($result === false) {
        echo "Error in registration \n";
        throw new Exception("Curl error: " . curl_error($crl));
    } else {
        $res_data = json_decode($result);
        var_dump($res_data);
        echo "Done with registration \n";
        echo "Settig neccessary plugin information";
        $option_key = $plugin_name . "_register_data";
        delete_option( $option_key );
        add_option( $option_key, array(
            "user_token" => $res_data->user_token,
            "domain" => $domain,
            "customer_id" => $customer_id,
            "patrner_id" => $patrner_id
        ));
        echo "done";
    }

    // Close cURL session handle
    curl_close($crl);

    return $result;
}

?>
