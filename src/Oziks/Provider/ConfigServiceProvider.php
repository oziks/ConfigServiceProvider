<?php

/*
 * This file is part of the oziks/ConfigServiceProvider.
 *
 * (c) Morgan Brunot <brunot.morgan@gmail.com>
 */

namespace Oziks\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

use Symfony\Component\Config\FileLocator;

use Oziks\Lib\Config;

/**
 * ConfigServiceProvider.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['config.path'] = array();

        $app['config'] = $app->share(function ($app) {
            return new Config($app['config.path']);
        });
    }

    public function boot(Application $app)
    {
    }
}
