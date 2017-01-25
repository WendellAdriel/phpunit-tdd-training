<?php

use PHPUnit\Framework\TestCase;
use Auction\ValueObjects\Price;

class PriceTest extends TestCase
{
    /**
     * @test
     */
    public function hasValidStartingPrice()
    {
        $price = new Price(3.5);
        $this->assertEquals(3.5, $price->getPrice());
    }

    /**
     * @test
     */
    public function hasInvalidStartingPrice()
    {
        $this->expectException(InvalidArgumentException::class);
        $price = new Price(0);
    }
}