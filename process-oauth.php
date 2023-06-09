<?php

function addUserToGuild($discord_ID, $token, $guild_ID) {
    // Assuming you have an API endpoint to add a user to a guild
    $url = "https://discord.com/api/v9/guilds/{$guild_ID}/members/{$discord_ID}";

    // Set up the HTTP headers, including the bot token
    $headers = array(
        'Authorization: Bot ' . $token,
        'Content-Type: application/json',
    );

    // Set up the HTTP request options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_HTTPHEADER => $headers,
    );

    // Initialize the cURL session
    $curl = curl_init();
    
    // Set the cURL options
    curl_setopt_array($curl, $options);

    // Execute the request and get the response
    $response = curl_exec($curl);

    // Check for any cURL errors
    if (curl_errno($curl)) {
        $error_message = curl_error($curl);
        // Handle the error accordingly
        // For example, you could throw an exception or return an error message
        curl_close($curl);
        throw new Exception("cURL Error: " . $error_message);
    }

    // Close the cURL session
    curl_close($curl);

    // Process the response, if needed
    // ...

    // Return any relevant data from the response, if needed
    // ...
}

function getUsersGuilds($auth_token) {
    // Assuming you have an API endpoint to retrieve the user's guilds
    $url = 'https://api.example.com/user/guilds';

    // Set up the HTTP headers, including the authentication token
    $headers = array(
        'Authorization: Bearer ' . $auth_token,
        'Content-Type: application/json',
    );

    // Set up the HTTP request options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
    );

    // Initialize the cURL session
    $curl = curl_init();
    
    // Set the cURL options
    curl_setopt_array($curl, $options);

    // Execute the request and get the response
    $response = curl_exec($curl);

    // Check for any cURL errors
    if(curl_errno($curl)){
        $error_message = curl_error($curl);
        // Handle the error accordingly
        // For example, you could throw an exception or return an error message
        curl_close($curl);
        throw new Exception("cURL Error: " . $error_message);
    }

    // Close the cURL session
    curl_close($curl);

    // Process the response, assuming it's in JSON format
    $guilds = json_decode($response, true);

    // Return the guilds
    return $guilds;
}


?>