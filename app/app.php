<?php

/**
 * Application's settings.
 */

use SatanGoss\Provider\TelegramServiceProvider;
use SatanGoss\Provider\TwitterServiceProvider;
use Silex\Application;
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

$app->before(function (Request $request, Application $app){
    try {
        $dbConnection = new \PDO('pgsql:dbname=d5vv3r52jtejid;host=ec2-54-235-255-27.compute-1.amazonaws.com;user=fdzewgxayvgngl;password='.getenv('DB.LOGS'));

    } catch (\Exception $exception) {
        var_dump($exception);
    }
});

$app->error(function (\Exception $e, $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    if ($code != 200) {
        return new JsonResponse(['error' => 'A wild error appeared!', 'code' => $code]);
    }
});

return $app;
