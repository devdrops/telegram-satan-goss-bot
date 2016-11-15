<?php

namespace SatanGoss\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class TwitterServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['twitter'] = new \TwitterAPIExchange($app['twitter.settings']);
    }
}
