<?php

/**
 * Application's routes.
 */

$app->get('/setup', 'SatanGoss\Controller\IndexController::setupBotAction');

$app->post('/action', 'SatanGoss\Controller\BotController::webhookAction');
