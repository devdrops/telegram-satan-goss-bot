<?php

/**
 * Application's routes.
 */

$app->post('/action', 'IgorBot\Controller\BotController::webhookAction');
