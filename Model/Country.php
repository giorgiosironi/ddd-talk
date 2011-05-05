<?php
namespace Model;

/**
 * @Entity
 */
class Country
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToMany(targetEntity="Model\City", cascade={"persist", "remove"})
     * @JoinTable(name="countries_cities",
     *            joinColumns={@JoinColumn(name="country_id", referencedColumnName="id")},
     *            inverseJoinColumns={@JoinColumn(name="city_id", referencedColumnName="id", unique=true)})
     */
    private $cities;

    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function addCity(City $city)
    {
        $this->cities->add($city);
    }

    public function getCities()
    {
        return $this->cities;
    }
}
