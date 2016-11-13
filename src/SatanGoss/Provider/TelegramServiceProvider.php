<?php

namespace SatanGoss\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class TelegramServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['telegram'] = new \Longman\TelegramBot\Telegram(
            $app['telegram.settings']['bot_key'],
            $app['telegram.settings']['bot_name']
        );

        $app['telegram']->addCommandsPath($app['telegram.settings']['command_path']);
    }
}
