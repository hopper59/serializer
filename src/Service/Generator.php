<?php

namespace App\Service;

use App\Entity\Item;
use Symfony\Component\Serializer\SerializerInterface;

class Generator
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function json()
    {
        $items = $this->makeItemsComplex();
        return $this->serializer->serialize($items, 'json', ['groups' => 'all']);
    }

    public function xml()
    {
        $items = $this->makeItems();
        return $this->serializer->serialize($items, 'xml');
    }

    public function fromJson()
    {
        $json = $this->makeItemsComplexString();

        return $this->serializer->deserialize($json, Item::class.'[]', 'json');
    }

    private function makeItems()
    {
        $items = [];
        for ($i = 1; $i < 3; $i++) {
            $items[] = new Item('item'.$i, $i*3);
        }

        return $items;
    }

    private function makeItemsComplex()
    {
        $items = $this->makeItems();
        $newItem = new Item('itemStacked', 10);
        $child1 = new Item('child1', 0);
        $child2 = new Item('child2', 0);
        $newItem->setGroupedItem([$child1, $child2]);
        $items[] = $newItem;

        return $items;
    }

    private function makeItemsString()
    {
        return'[{"name":"item1","price":3,"groupedItem":[]},{"name":"item2","cost":6,"groupedItem":[]},{"name":"itemStacked","cost":10,"groupedItem":[]}]';
    }

    private function makeItemsComplexString()
    {
        return'[{"name":"item1","cost":3,"groupedItem":[]},{"name":"item2","cost":6,"groupedItem":[]},{"name":"itemStacked","inStock":true,"cost":10,"groupedItem":[{"name":"child1","cost":0,"groupedItem":[]},{"name":"child2","cost":0,"groupedItem":[]}]}]';
    }
}
