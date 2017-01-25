<?php

use \PHPUnit\Framework\TestCase;
use \Auction\Models\Bid;
use \Auction\Models\User;
use \Auction\ValueObjects\Email;
use \Auction\ValueObjects\Name;
use \Auction\ValueObjects\Price;

class BidTest extends TestCase
{
    private $bid;

    public function setUp()
    {
        $name  = new Name('Quim Pistolas');
        $email = new Email('quim@mail.com');
        $user  = new User($name, $email);
        $price = new Price(10.0);

        $this->bid = new Bid($user, $price);
    }

    /**
     * @test
     */
    public function hasUser()
    {
        $this->assertNotNull($this->bid->getUser());
    }

    /**
     * @test
     */
    public function hasPrice()
    {
        $this->assertNotNull($this->bid->getPrice());
    }
}