<?php

/**
 * Project's settings.
 */

$app['telegram.settings'] = [
    'bot_key' => getenv('TELEGRAM.BOT_KEY'),
    'bot_name' => getenv('TELEGRAM.BOT_NAME'),
    'webhook' => getenv('TELEGRAM.WEBHOOK'),
    'command_path' => __DIR__.'/../../src/SatanGoss/Command/',
];

$app['twitter.settings'] = [
//    'oauth_access_token' => getenv('TWITTER.ACCESS_TOKEN'),
//    'oauth_access_token_secret' => getenv('TWITTER.ACCESS_TOKEN_SECRET'),
//    'consumer_key' => getenv('TWITTER.CONSUMER_KEY'),
//    'consumer_secret' => getenv('TWITTER.CONSUMER_SECRET'),

    'oauth_access_token' => '147370299-CSyzmzVxYCS0F1PoFBcbzccFKJOO0kWgmG8bA3Gx',
    'oauth_access_token_secret' => '18lVPHgYbKac7Vg2tdEz8kw8Q7TOGR6c82Z9buIRmrVGa',
    'consumer_key' => 'jQpeodtWCdqPrrPwCtMt4VTRp',
    'consumer_secret' => 'IpBoheAGmKj5jO25JtHg8Rlu2rskqETENwnVfsRz9FcsPMLd6X',
];
