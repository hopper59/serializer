<?php

namespace App\Entity;

class Item
{
    private $name;

    private $price;

    private $groupedItem = [];

    private $inStock;

    public function __construct(string $name, float $price, bool $inStock = true)
    {
        $this->name = $name;
        $this->price = $price;
        $this->inStock = $inStock;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

    public function getGroupedItem()
    {
        return $this->groupedItem;
    }

    public function setGroupedItem(array $groupedItem)
    {
        $this->groupedItem = $groupedItem;

        return $this;
    }

    public function isInStock()
    {
        return $this->inStock;
    }

    public function setInStock(bool $inStock)
    {
        $this->inStock = $inStock;
        return $this;
    }
}
