<?php

/**
 * Application's settings.
 */

use SatanGoss\Provider\TelegramServiceProvider;
use SatanGoss\Provider\TwitterServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$app->register(
    new TelegramServiceProvider(),
    $app['telegram.settings']
);

$app->register(
    new TwitterServiceProvider(),
    $app['twitter.settings']
);

$app->error(function (\Exception $e, $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    if ($code != 200) {
        return new JsonResponse(['error' => 'A wild error appeared!', 'code' => $code]);
    }
});

return $app;
