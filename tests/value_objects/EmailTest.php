<?php

use PHPUnit\Framework\TestCase;
use Auction\ValueObjects\Email;

class EmailTest extends TestCase
{
    /**
     * @test
     */
    public function hasValidEmail()
    {
        $email = new Email('john@example.com');
        $this->assertEquals('john@example.com', $email);
    }

    /**
     * @test
     */
    public function hasInvalidEmail()
    {
        $this->expectException(InvalidArgumentException::class);
        $email = new Email('john');
    }
}