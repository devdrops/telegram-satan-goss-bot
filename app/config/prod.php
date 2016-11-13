<?php

/**
 * Project's settings.
 */

$app['cache.path'] = __DIR__ . '/../cache';

$app['telegram.settings'] = [
    'bot_key' => '291444591:AAE-ZHObr9ySHcx8B8l2pOaxqkmfNlJlPE4',
    'bot_name' => 'SatanGossBot',
    'webhook' => 'https://satan-goss.herokuapp.com/action',
    'command_path' => __DIR__.'/../../src/SatanGoss/Command/',
];
