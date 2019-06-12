<?php

namespace App\Entity;

class Employee
{
    private $firstName;

    private $lastName;

    private $shop;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getShop()
    {
        return $this->shop;
    }

    public function setShop(Shop $shop)
    {
        $this->shop = $shop;
        return $shop;
    }
}
