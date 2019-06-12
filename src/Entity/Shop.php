<?php

namespace App\Entity;

class Shop
{
    private $name;

    private $address;

    private $empolyees;

    private $items;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getEmployees()
    {
        return $this->employees;
    }

    public function setEmployees(array $employees)
    {
        $this->employees = [];
        foreach ($employees as $employee)
        {
            $this->addEmployee($employee);
        }
        return $this;
    }

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems(array $items)
    {
        $this->items = [];
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }
}
