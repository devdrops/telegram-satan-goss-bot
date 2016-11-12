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
        $app['monolog']->addInfo('['.date('Y-m-d H:i:s').'] CONTENTS: '.print_r($request->getContent(), true));

        return new JsonResponse(['whois' => 'MACGAREN FATHER']);
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
