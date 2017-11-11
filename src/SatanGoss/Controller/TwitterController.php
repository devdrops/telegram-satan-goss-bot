<?php

namespace SatanGoss\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\Telegram\Types\Update;

/**
 * @author Davi Marcondes Moreira (@devdrops) <davi.marcondes.moreira@gmail.com>
 */
class TwitterController
{
    public function queryAction(Request $request, Application $app)
    {
        try {
            $query = '#phptestfest #phpsp #pagarme'; 

            $hashtagSearch = $app['twitter']->get(
                'search/tweets',
                ['q' => $query]
            );



            return new JsonResponse([
                'tweets' => $hashtagSearch->statuses,
                'full' => $hashtagSearch,
                'query' => $query,
            ]);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
