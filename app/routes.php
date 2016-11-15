<?php

/**
 * Application's routes.
 */

$app->get('/setup', 'SatanGoss\Controller\IndexController::setupBotAction');

$app->post('/action', 'SatanGoss\Controller\BotController::webhookAction');

$app->get('/tweet/{message}', 'SatanGoss\Controller\IndexController::tweetAction');
