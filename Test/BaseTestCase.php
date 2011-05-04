<?php
namespace Test;
use Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Tools\SchemaTool;

abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    private static $connectionOptions;
    private static $config;
    protected $em;

    public static function setConfiguration(array $connectionOptions, \Doctrine\ORM\Configuration $config)
    {
        self::$connectionOptions = $connectionOptions;
        self::$config = $config;
    }

    public function setUp()
    {
        $this->em = EntityManager::create(self::$connectionOptions, self::$config);
        $tool = new SchemaTool($this->em);
        $classes = array(
            $this->em->getClassMetadata('Model\Customer')
        );
        $tool->createSchema($classes);
    }
}
