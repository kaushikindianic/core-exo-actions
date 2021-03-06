<?php

require_once __DIR__.'/../../autoload.php';

use Exo\Toolkit\Runner;
use GuzzleHttp\Client;
use ThibaudDauce\Mattermost\Mattermost;
use ThibaudDauce\Mattermost\Message;

$run = Runner::run(function ($request) {
    $input = $request['input'];
    $url = $input['url'];
    $channel = $input['channel'];
    $text = $input['text'];

    $channels = array_map('trim', explode(',', $channel));

    foreach ($channels as $key => $channel) {
        $mattermost = new Mattermost(new Client());

        $message = (new Message())
            ->text($text)
            ->channel($channel);

        $mattermost->send($message, $url);
    }

    $response = [
        'status' => 'OK',
    ];

    return $response;
});
