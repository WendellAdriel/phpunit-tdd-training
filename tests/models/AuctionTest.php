<?php

use Auction\Models\Auction;
use Auction\Models\Bid;
use Auction\Models\User;
use Auction\ValueObjects\Description;
use Auction\ValueObjects\Email;
use Auction\ValueObjects\Name;
use Auction\ValueObjects\Price;
use PHPUnit\Framework\TestCase;


class AuctionTest extends TestCase
{
    private $auction;

    public function setUp()
    {
        $description = new Description('La descripcion. Oh la la!');
        $startDate   = new DateTime('now');
        $endDate     = (new DateTime('now'))->modify('+1 day');
        $price       = new Price(20.0);
        $name        = new Name('Quim Pistolas');
        $email       = new Email('quim@mail.com');
        $user        = new User($name, $email);
        $this->auction = new Auction($description, $startDate, $endDate, $user, $price);
    }

    /**
     * @test
     */
    public function hasDescription()
    {
        $this->assertNotNull($this->auction->getDescription());
    }

    /**
     * @test
     */
    public function hasStartDate()
    {
        $this->assertNotNull($this->auction->getStartDate());
    }

    /**
     * @test
     */
    public function hasEndDate()
    {
        $this->assertNotNull($this->auction->getEndDate());
    }

    /**
     * @test
     */
    public function hasStartingPrice()
    {
        $this->assertNotNull($this->auction->getStartingPrice());
    }

    /**
     * @test
     */
    public function hasSeller()
    {
        $this->assertNotNull($this->auction->getSeller());
    }

    /**
     * @test
     */
    public function isBidEmptyOnStart()
    {
        $this->assertEmpty($this->auction->getBids());
    }

    /**
     * @test
     */
    public function addValidBid()
    {
        $user = new User(new Name('Tony'), new Email('tony@soprano.com'));
        $price = new Price(50.0);
        $bid   = new Bid($user, $price);

        $this->auction->addBid($bid);

        $this->assertEquals($this->auction->getBids()[0], $bid);
    }

    /**
     * @test
     */
    public function throwsExceptionOnInvalidFirstBidPrice()
    {
        $this->expectException(\Exception::class);
        $user = new User(new Name('Tony'), new Email('tony@soprano.com'));
        $price = new Price(10.0);

        $this->auction->addBid(new Bid($user, $price));
    }

    /**
     * @test
     */
    public function throwsExceptionOnLowerBidPrice()
    {
        $this->expectException(\Exception::class);
        $user     = new User(new Name('Tony'), new Email('tony@soprano.com'));
        $priceOne = new Price(30.0);
        $priceTwo = new Price(25.0);

        $this->auction->addBid(new Bid($user, $priceOne));
        $this->auction->addBid(new Bid($user, $priceTwo));
    }

    /**
     * @test
     */
    public function addTwoValidBids()
    {
        $user     = new User(new Name('Tony'), new Email('tony@soprano.com'));
        $priceOne = new Price(30.0);
        $priceTwo = new Price(35.0);

        $this->auction->addBid(new Bid($user, $priceOne));
        $this->auction->addBid(new Bid($user, $priceTwo));
        $this->assertEquals(2, count($this->auction->getBids()));
    }

    /**
     * @test
     */
    public function throwsExceptionOnBidFromSeller()
    {
        $this->expectException(\Exception::class);

        $name        = new Name('Quim Pistolas');
        $email       = new Email('quim@mail.com');
        $user        = new User($name, $email);
        $price       = new Price(50.0);

        $this->auction->addBid(new Bid($user, $price));
    }
}