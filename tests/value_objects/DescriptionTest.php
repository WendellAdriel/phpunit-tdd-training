<?php

use PHPUnit\Framework\TestCase;
use Auction\ValueObjects\Description;

class DescriptionTest extends TestCase
{
    /**
     * @test
     */
    public function hasValidDescription()
    {
        $description = new Description('An awesome description');
        $this->assertEquals('An awesome description', $description);
    }

    /**
     * @test
     */
    public function hasInvalidDescription()
    {
        $this->expectException(InvalidArgumentException::class);
        $description = new Description('Too bad');
    }
}