<?php

/**
 * Application's routes.
 */

$app->get('/', 'SatanGoss\Controller\IndexController::indexAction')->bind('home');

$app->get('/bot', 'SatanGoss\Controller\IndexController::botAction')->bind('bot');
$app->post('/bot', 'SatanGoss\Controller\IndexController::hiBotAction');

$app->get('/setup', 'SatanGoss\Controller\IndexController::setupBotAction');

$app->post('/action', 'SatanGoss\Controller\BotController::webhookAction');
