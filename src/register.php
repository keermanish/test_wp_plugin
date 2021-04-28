<?php

function post_data(
    string $domain,
    string $customer_id,
    string $patrner_id,
    string $wp_dir
) {
    // load wp functions
    require_once "$wp_dir/wp-load.php";

    echo "passed information $domain, $customer_id, $patner_id";

    $payload = json_encode([
        "domain" => $domain,
        "customer_id" => $customer_id,
        "patner_id" => $patner_id
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

    echo "result $result";

    // handle curl error
    if ($result === false) {
        throw new Exception("Curl error: " . curl_error($crl));
    } else {
        echo "Done with bll registration!";
        // TODO: set options
    }

    // Close cURL session handle
    curl_close($crl);

    return $result;
}

?>
