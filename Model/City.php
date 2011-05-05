<?php
namespace Model;

/**
 * @Entity
 */
class City
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
