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
class BotController
{
    public function webhookAction(Request $request, Application $app)
    {
        try {
            $update = new Update(json_decode($request->getContent(), true));

            $message = new SendMessage();
            $message->chat_id = $update->message->chat->id;

            /*$query = '#phptestfest #phpsp #pagarme';

            $hashtagSearch = $app['twitter']->get(
                'search/tweets',
                [
                    'q' => $query,
                    'count' => 100,
                    'result_type' => 'recent',
                ]
            );

            $tweets = [];
            foreach ($hashtagSearch->statuses as $item) {
                if (true == $request->query->get('rt', null)
                    && (
                        true == $item->retweeted
                        || 0 === strpos($item->text, 'RT')
                    )
                ) {
                    continue;
                }

                $filtered = new \stdClass;

                $filtered->created_at = $item->created_at;
                $filtered->text = $item->text;
                $filtered->user = $item->user->name;
                $filtered->userName = $item->user->screen_name;
                $filtered->isRT = $item->retweeted;

                $tweets[] = $filtered;
            }*/
 
            $message->text = print_r(
                get_class_methods(get_class($update)),
                true
            );

            $app['telegram']->performApiRequest($message);

            if (true !== $result) {
                return new JsonResponse(['status' => 'Houston, we have a problem.'], 500);
            }
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
