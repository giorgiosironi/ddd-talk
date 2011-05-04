<?php
namespace Test;
use Model\Customer;

class EntityStorageTest extends BaseTestCase
{
    public function testANonActiveRecordEntityIsStoredAndRetrieved()
    {
        $customer = new Customer;
        $customer->setName('Giorgio');
        $this->em->persist($customer);
        $this->em->flush();
        $this->assertEquals(1, $customer->getId());

        $this->em->clear();
        $retrieved = $this->em->find('Model\Customer', 1);
        $this->assertEquals('Giorgio', $retrieved->getName());
    }
}
