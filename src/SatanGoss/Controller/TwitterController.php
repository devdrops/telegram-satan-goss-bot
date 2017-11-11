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

            $foo = array_map(
                $hashtagSearch->statuses,
                function ($item) {
                    
                    var_dump($item);die();

                    $filtered = new \stdClass;

                    $filtered->created_at = $item->created_at;
                    $filtered->text = $item->text;
                    $filtered->user = $item->user->name;
                    $filtered->userName = $item->user->screen_name;
                    $filtered->isRT = $item->retweeted;

                    return $filtered;
                }
            );

            return new JsonResponse([
                'full' => $foo,
                'tweets' => $hashtagSearch->statuses,
                'metadata' => $hashtagSearch->search_metadata,
            ]);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
