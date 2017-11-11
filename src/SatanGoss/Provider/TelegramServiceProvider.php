<?php

namespace SatanGoss\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use unreal4u\TelegramAPI\Telegram\Methods\SetWebhook;
use unreal4u\TelegramAPI\TgLog;

class TelegramServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['telegram'] = new TgLog(
            $app['telegram.settings']['bot_key']
        );

        $app['telegram']->performApiRequest($setWebhook);
    }
}
