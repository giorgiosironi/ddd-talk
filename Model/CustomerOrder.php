<?php
namespace Model;

/**
 * @Entity
 */
class CustomerOrder
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="object", nullable="true")
     */
    private $paymentMethodSerialized;

    public function setPaymentMethodSerialized(PaymentMethod $method)
    {
        $this->paymentMethodSerialized = $method;
    }

    public function getPaymentMethodSerialized()
    {
        return $this->paymentMethodSerialized;
    }
}
