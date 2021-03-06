Silex 2.x Geoip Provider
==========================

## Installing the GeoipProvider in a Silex project
The installation process is actually very simple.  Set up a Silex project with Composer.

Once the new project is set up, open the composer.json file and add the exs/silex-geoip-provider as a dependency:
``` js
//composer.json
//...
"require": {
        //other bundles
        "exs/silex-geoip-provider": "^v1.0"
```

Save the file and have composer update the project via the command line:
``` shell
php composer.phar update
```

or run this command:
``` shell 
    composer require exs/silex-geoip-provider v1.0
```

Composer will now update all dependencies and you should see our bundle in the list:
``` shell
  - Installing exs/silex-geoip-provider (dev-master 463eb20)
    Cloning 463eb2081e7205e7556f6f65224c6ba9631e070a
```

Update the app.php to include our provider:
``` php
//app.php
//...
$app->register(new \EXS\GeoipProvider\Providers\GeoipProvider(),array('maxmind.database.file'=>'/path/to/your/file/GeoIPCity.dat'));

$service = $app['exs.serv.geoip'];
$country_code = $service->getGeoipCountryCode('8.8.8.8');
//or
$country = $service->getCountryByReader('8.8.8.8);
```
and now you're done.

#### Contributing ####
Anyone and everyone is welcome to contribute.

If you have any questions or suggestions please [let us know][1].

[1]: http://www.ex-situ.com/