<?php
namespace Test;
use Model\CustomerOrder;

class ServiceTest extends BaseTestCase
{
    public function testAnEntityMayDependeOverAServiceInterfaceToPerformDoubleDispatch_EmptyOrderShipsNoProduct()
    {
        $order = new CustomerOrder;
        $service = $this->getMock('Model\ShippingService');
        $service->expects($this->once())
                ->method('shipProducts')
                ->with(array());
        $order->ship($service);
    }
}
