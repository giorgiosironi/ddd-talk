<?php
// Doctrine 2 must be installe via PEAR
require 'Doctrine/Common/ClassLoader.php';
$classLoader = new \Doctrine\Common\ClassLoader('Doctrine', null);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Test', __DIR__);
$classLoader->register();

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;

$cache = new \Doctrine\Common\Cache\ArrayCache;

$config = new Configuration;
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(__DIR__ . '/models');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir(__DIR__  . '/proxies');
$config->setProxyNamespace('Proxies');

$config->setAutoGenerateProxyClasses(true);

$connectionOptions = array(
    'driver' => 'pdo_sqlite',
    'path' => 'database.sqlite'
);

Test\BaseTestCase::setConfiguration($connectionOptions, $config);
unset($em, $connectionOptions, $config, $driverImpl, $cache, $classLoader);

