<?php

namespace EXS\GeoipProvider\Providers;

use Pimple\ServiceProviderInterface;
use Pimple\Container;

/**
 * Abstract services for Maxmind GeopIp Country Detection
 *
 * Created 1-May-2015
 * @author Damien Demessence <damiend@ex-situ.com>
 * @copyright   Copyright 2015 ExSitu Marketing.
 */
class GeoipProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['exs.serv.geoIp'] = ( function ($container) {
            return new \EXS\GeoipProvider\Services\GeoIPService($container['maxmind.database.file']);
        });
    }
}
