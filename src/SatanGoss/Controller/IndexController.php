<?php

namespace SatanGoss\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author Davi Marcondes Moreira (@devdrops) <davi.marcondes.moreira@gmail.com>
 */
class IndexController
{
    public function indexAction(Request $request, Application $app)
    {
        return new JsonResponse(['whois' => 'THE MIGHTY SATAN GOSS']);
    }

    public function botAction(Request $request, Application $app)
    {
        $contents = $request->getContent();

        if (isset($contents['chat_id'])) {
            return new JsonResponse(['whois' => 'TELEGRAM IS HERE']);
        } else {
            return new JsonResponse(['whois' => 'MACGAREN FATHER']);
        }
    }

    public function setupBotAction(Request $request, Application $app)
    {
        try {
            $telegram = new \Longman\TelegramBot\Telegram(
                $app['telegram']['bot_key'],
                $app['telegram']['bot_name']
            );

            $result = $telegram->setWebHook($app['telegram']['webhook']);

            if ($result->isOk()) {
                return new JsonResponse([$result->getDescription()]);
            }
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }

    public function hiBotAction(Request $request, Application $app)
    {
        var_dump($request->getContent());
    }
}
