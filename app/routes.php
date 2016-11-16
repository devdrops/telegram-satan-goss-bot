<?php

/**
 * Application's routes.
 */

$app->get('/setup', 'SatanGoss\Controller\IndexController::setupBotAction');

$app->get('/tweet', 'SatanGoss\Controller\IndexController::tweetAction');

$app->post('/action', 'SatanGoss\Controller\BotController::webhookAction');
