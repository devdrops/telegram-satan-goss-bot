<?php

/**
 * Application's settings.
 */

use Silex\Provider\MonologServiceProvider;
use Symfony\Component\HttpFoundation\Response;

$app->register(
    new MonologServiceProvider(),
    ['monolog.logfile' => __DIR__ . '/../logs/logfile.log']
);

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message, $code);
});

return $app;
