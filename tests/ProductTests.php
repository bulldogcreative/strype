<?php

include 'boot.php';

use PHPUnit\Framework\TestCase;
use Bulldog\Strype\Strype;
use Bulldog\id\ObjectId;
use Bulldog\Strype\Models\Products\Good;
use Bulldog\Strype\Models\Products\Service;

class ProductTests extends TestCase
{
    public $strype;
    public $id;

    public function setUp()
    {
        $this->strype = new Strype(getenv('STRIPE_API_KEY'));
        $this->id = new ObjectId();
    }

    public function testCreateProduct()
    {
        $good = new Good('Sweater', ['description' => 'Blue']);
        $product = $this->strype->product()->create($good, $this->id->get(12));
        $this->assertEquals('product', $product->object);
        $this->assertEquals('Blue', $product->description);
        $this->assertEquals('Sweater', $product->name);
        $this->assertEquals('good', $product->type);
        $product->getResponse()->delete();
    }

    public function testCreateServiceProduct()
    {
        $service = new Service('Sweater Repair');
        $product = $this->strype->product()->create($service, $this->id->get(12));
        $this->assertEquals('product', $product->object);
        $this->assertEquals('Sweater Repair', $product->name);
        $this->assertEquals('service', $product->type);
        $product->getResponse()->delete();
    }

    public function testRetrieveProduct()
    {
        $good = new Good('Sweater', ['description' => 'Blue']);
        $product = $this->strype->product()->create($good, $this->id->get(12));

        $retrieved = $this->strype->product()->retrieve($product->getId());
        $this->assertEquals($product->description, $retrieved->description);
        $retrieved->getResponse()->delete();
    }

    public function testUpdateProduct()
    {
        $good = new Good('Sweater', ['description' => 'Blue']);
        $product = $this->strype->product()->create($good, $this->id->get(12));

        $updateProduct = $this->strype->product()->update($product->getId(), ['description' => 'orange']);

        $retrieved = $this->strype->product()->retrieve($product->getId());
        $this->assertEquals('orange', $retrieved->description);
        $product->getResponse()->delete();
    }

    public function testListAll()
    {
        for ($i = 0; $i < 10; ++$i) {
            $good[$i] = new Good('Sweater '.$i, ['description' => 'Blue']);
            $product[$i] = $this->strype->product()->create($good[$i], $this->id->get(12));
        }
        $products = $this->strype->product()->listAll(['limit' => 3]);
        $this->assertEquals(3, count($products->data));
        for ($i = 0; $i < 10; ++$i) {
            $product[$i]->getResponse()->delete();
        }
    }
}
