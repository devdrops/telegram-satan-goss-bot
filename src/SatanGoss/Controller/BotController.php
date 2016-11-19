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
            $update = new Update($request->getContent());

            $message = new SendMessage();
            $message->chat_id = $update->message->chat->id;
            $message->text = 'Time is '.microtime();

            $app['telegram']->performApiRequest($message);

            /*
            $post = json_decode($input, true);
            if (empty($post)) {
                throw new \Exception('Invalid JSON!');
            }

            $update = new Update($post, $app['telegram.settings']['TELEGRAM.BOT_NAME']);

            $result = $app['telegram']->processUpdate($update)->isOk();

            if (true !== $result) {
                return new JsonResponse(['status' => 'Houston, we have a problem.'], 500);
            }
            */

            return new JsonResponse(['status' => 'The eagle has landed!']);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
