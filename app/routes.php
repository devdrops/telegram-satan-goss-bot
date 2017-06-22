<?php

/**
 * Application's routes.
 */

$app->post('/action', 'SatanGoss\Controller\BotController::webhookAction');
$app->post('/payments', 'SatanGoss\Controller\BotController::webhookAction');

