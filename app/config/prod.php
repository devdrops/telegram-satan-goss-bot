<?php

/**
 * Project's settings.
 */

$app['cache.path'] = __DIR__ . '/../cache';

$app['telegram.settings'] = [
    'bot_key' => getenv('CONFIG.BOT_KEY'),
    'bot_name' => getenv('CONFIG.BOT_NAME'),
    'webhook' => getenv('CONFIG.WEBHOOK'),
    'command_path' => __DIR__.'/../../src/SatanGoss/Command/',
];
