<?php

namespace SatanGoss\Controller;

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
            $result = $app['telegram']->handle();

            if (true !== $result) {
                return new JsonResponse(['status' => 'Houston, we have a problem.'], 500);
            }

            return new JsonResponse(['status' => 'The eagle has landed!']);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
