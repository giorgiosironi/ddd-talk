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

    /**
     * @Column(type="payment_method", nullable="true")
     */
    private $paymentMethodCustomMapping;

    public function setPaymentMethodSerialized(PaymentMethod $method)
    {
        $this->paymentMethodSerialized = $method;
    }

    public function getPaymentMethodSerialized()
    {
        return $this->paymentMethodSerialized;
    }

    public function setPaymentMethodCustomMapping(PaymentMethod $method)
    {
        $this->paymentMethodCustomMapping = $method;
    }

    public function getPaymentMethodCustomMapping()
    {
        return $this->paymentMethodCustomMapping;
    }
}
