<?php
/**
 * Created by PhpStorm.
 * User: wendell_adriel
 * Date: 25-01-2017
 * Time: 14:44
 */

namespace Auction\Models;


use Auction\ValueObjects\Price;

class Bid
{
    /** @var User */
    private $user;

    /** @var Price */
    private $price;

    /**
     * Bid constructor.
     * @param $user
     * @param $price
     */
    public function __construct(User $user, Price $price)
    {
        $this->user = $user;
        $this->price = $price;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return float
     */
    public function getBidPrice(): float
    {
        return $this->price->getPrice();
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }
}