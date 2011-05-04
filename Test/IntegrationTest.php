<?php
namespace Test;

class IntegrationTest extends BaseTestCase
{
    public function testEntityManagerIsCreated()
    {
        $this->assertTrue($this->em instanceof \Doctrine\ORM\EntityManager);
    }
}
