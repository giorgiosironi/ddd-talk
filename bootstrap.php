<?php
// Doctrine 2 must be installe via PEAR
require 'Doctrine/Common/ClassLoader.php';
$classLoader = new \Doctrine\Common\ClassLoader('Doctrine', null);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Test', __DIR__);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Model', __DIR__);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Proxy', __DIR__);
$classLoader->register();

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;

$cache = new \Doctrine\Common\Cache\ArrayCache;

$config = new Configuration;
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(__DIR__ . '/Model');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir(__DIR__  . '/Proxy');
$config->setProxyNamespace('Proxy');

$config->setAutoGenerateProxyClasses(true);

$connectionOptions = array(
    'driver' => 'pdo_sqlite',
    'path' => ':memory:'
);

Test\BaseTestCase::setConfiguration($connectionOptions, $config);
unset($em, $connectionOptions, $config, $driverImpl, $cache, $classLoader);

