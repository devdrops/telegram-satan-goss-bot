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
    public function setupBotAction(Request $request, Application $app)
    {
        try {
            $result = $app['telegram']->setWebHook($app['telegram.settings']['webhook']);

            if ($result->isOk()) {
                return new JsonResponse([$result->getDescription()]);
            }

            return new JsonResponse(['failure' => print_r($result, true)], 500);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }
}
