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
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    }

    public function indexAction(Request $request, Application $app)
    {
        return new JsonResponse(['FOO' => getenv('FOO')]);
    }
}
