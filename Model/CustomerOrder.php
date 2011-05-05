<?php
namespace Model;

/**
 * @Entity
 * @HasLifecycleCallbacks
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

    /**
     * @Column(type="string", nullable="true")
     */
    private $paymentMethodLifecycleHooksName;

    /**
     * @Column(type="string", nullable="true")
     */
    private $paymentMethodLifecycleHooksType;

    private $paymentMethodLifecycleHooks;

    public function setPaymentMethodLifecycleHooks(PaymentMethod $method)
    {
        $this->paymentMethodLifecycleHooks = $method;
    }

    public function getPaymentMethodLifecycleHooks()
    {
        return $this->paymentMethodLifecycleHooks;
    }

    /**
     * @PrePersist @PreUpdate
     */
    public function _persistValueObjects()
    {
        if ($this->paymentMethodLifecycleHooks !== null) {
            $this->paymentMethodLifecycleHooksName = $this->paymentMethodLifecycleHooks->getName();
            $this->paymentMethodLifecycleHooksType = $this->paymentMethodLifecycleHooks->getType();
        }
    }

    /**
     * @PostLoad
     */
    public function _rebuildValueObjects()
    {
        if ($this->paymentMethodLifecycleHooksName !== null) {
            $this->paymentMethodLifecycleHooks = new PaymentMethod($this->paymentMethodLifecycleHooksName, $this->paymentMethodLifecycleHooksType);
        }
    }
}
