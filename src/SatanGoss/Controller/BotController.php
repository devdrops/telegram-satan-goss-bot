<?php

namespace SatanGoss\Controller;

use Longman\TelegramBot\Request as TelegramRequest;
use Longman\TelegramBot\Entities\Update;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author Davi Marcondes Moreira (@devdrops) <davi.marcondes.moreira@gmail.com>
 */
class BotController
{
    public function webhookAction(Request $request, Application $app)
    {
        try {
            $input = TelegramRequest::getInput();

            $post = json_decode($input, true);
            if (empty($post)) {
                throw new \Exception('Invalid JSON!');
            }

            $update = new Update($post, $app['telegram.settings']['TELEGRAM.BOT_NAME']);

            //$result = $app['telegram']->processUpdate($update)->isOk();
            $command = new \Longman\TelegramBot\Commands\UserCommands\TweetCommand(
                $app['telegram'],
                $update
            );
            $result = $command->execute();

            if (true !== $result) {
                return new JsonResponse(['status' => 'Houston, we have a problem.'], 500);
            }

            return new JsonResponse(['status' => 'The eagle has landed!']);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
