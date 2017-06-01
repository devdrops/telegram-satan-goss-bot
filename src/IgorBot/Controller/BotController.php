<?php

namespace IgorBot\Controller;

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

            $message->text = 'Comando recebido :)'; 
            $app['telegram']->performApiRequest($message);

            return new JsonResponse('Done!');

            if (isset($update->message->entities)
                && $update->message->entities[0]->type === 'bot_command'
                && 0 === strpos($update->message->text, '/show')
            ) {
                $message = new SendMessage();
                $message->chat_id = $update->message->chat->id;

                $botSentences = [
                    'show',
                    'shooooow',
                ];

                $message->text = $botSentences[array_rand($botSentences)];

                $app['telegram']->performApiRequest($message);

                return new JsonResponse('Ok!');
            } else {
                $message = new SendMessage();
                $message->chat_id = $update->message->chat->id;
                $message->text = 'wut?';

                $app['telegram']->performApiRequest($message);

                return new JsonResponse('Fail!');
            }
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
