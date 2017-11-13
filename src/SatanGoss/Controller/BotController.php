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
            
            if (isset($update->message->entities)
                && $update->message->entities[0]->type === 'bot_command'
                && 0 === strpos($update->message->text, '/pickawinner')
            ) {
                $message = new SendMessage();
                $message->chat_id = $update->message->chat->id;
                $query = substr(
                    $update->message->text,
                    trim(strpos($update->message->text, ' '))
                );

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
                    if (true == $item->retweeted 
                        || 0 === strpos($item->text, 'RT')
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
                }

                $count = count($tweets);
                $choosen = rand(1, $count);

                $response = 'Ok, here are the results:'.PHP_EOL.PHP_EOL
                    .' - Total of '.$count.' tweets;'.PHP_EOL
                    .' - And the choosen one is:'
                    .'`'.$tweets[$choosen]->userName.'`, with the message: __'
                    .$tweets[$choosen]->text.'__'.PHP_EOL
                    .'Congratulations!';

                $message->text = $response;

                $app['telegram']->performApiRequest($message);
            }

            return new JsonResponse(['status' => 'ok!'], 200);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
