<?php

namespace Strype;

use Bulldog\Strype\Models\Products\Good;
use Bulldog\Strype\Models\Products\Service;

class ProductTest extends TestCase
{
    public function testCreateProduct()
    {
        $good = new Good('Sweater', ['description' => 'Blue']);
        $product = $this->strype->product()->create($good, $this->id->get(12));
        $this->assertEquals('product', $product->object);
        $this->assertEquals('Sweater', $product->name);
        $this->assertEquals('good', $product->type);
        $this->assertInstanceOf("Stripe\\Product", $product->getResponse());
    }

    public function testCreateServiceProduct()
    {
        $service = new Service('Sweater Repair');
        $product = $this->strype->product()->create($service, $this->id->get(12));
        $this->assertEquals('product', $product->object);
        $this->assertEquals('Sweater Repair', $product->name);
        $this->assertEquals('service', $product->type);
        $this->assertInstanceOf("Stripe\\Product", $product->getResponse());
    }

    public function testRetrieveProduct()
    {
        $good = new Good('Sweater', ['description' => 'Blue']);
        $product = $this->strype->product()->create($good, $this->id->get(12));

        $retrieved = $this->strype->product()->retrieve($product->getId());
        $this->assertEquals($product->description, $retrieved->description);
        $this->assertInstanceOf("Stripe\\Product", $retrieved->getResponse());
    }

    public function testUpdateProduct()
    {
        $good = new Good('Sweater', ['description' => 'Blue']);
        $product = $this->strype->product()->create($good, $this->id->get(12));

        $updateProduct = $this->strype->product()->update($product->getId(), ['description' => 'orange']);

        $resource = $this->strype->product()->retrieve($product->getId());
        $this->assertInstanceOf("Stripe\\Product", $resource->getResponse());
    }

    public function testListAll()
    {
        $products = $this->strype->product()->listAll(['limit' => 1]);
        $this->assertEquals(1, count($products->data));
        $this->assertTrue(is_array($products->data));
    }
}
