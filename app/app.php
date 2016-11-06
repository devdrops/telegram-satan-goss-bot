<?php

/**
 * Application's settings.
 */

use Silex\Provider\MonologServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;

$app->register(
    new MonologServiceProvider(),
    ['monolog.logfile' => __DIR__ . '/../logs/logfile.log']
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
