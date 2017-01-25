<?php

use PHPUnit\Framework\TestCase;
use Auction\ValueObjects\Name;

class NameTest extends TestCase
{
    /**
     * @test
     */
    public function hasValidName()
    {
        $name = new Name('John');
        $this->assertEquals('John', $name);
    }

    /**
     * @test
     */
    public function hasInvalidName()
    {
        $this->expectException(InvalidArgumentException::class);
        $name = new Name('J');
    }
}