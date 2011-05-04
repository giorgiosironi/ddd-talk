<?php
namespace Test;
use Model\CustomerOrder,
    Model\PaymentMethod;

class ValueObjectTest extends BaseTestCase
{
    public function testValueObjectCanBeStoredAsASerializedObject()
    {
        $order = new CustomerOrder;
        $order->setPaymentMethodSerialized(new PaymentMethod("AMEX", "credit card"));
        $this->em->persist($order);
        $this->em->flush();
        $this->em->clear();

        $order = $this->em->find('Model\CustomerOrder', 1);
        $this->assertEquals(new PaymentMethod("AMEX", "credit card"), $order->getPaymentMethodSerialized());
    }
}
