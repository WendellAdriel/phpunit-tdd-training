<?php
declare(strict_types=1);

namespace Auction\ValueObjects;

class Price
{
    /** @var float */
    private $price;

    /**
     * StartingPrice constructor.
     * @param float $price
     */
    public function __construct(float $price)
    {
        if ($this->isValid($price)) {
            $this->price = $price;
            return;
        }
        throw new \InvalidArgumentException("Price is invalid");
    }

    /**
     * @param float $price
     * @return bool
     */
    private function isValid(float $price): bool
    {
        if ($price <= 0) {
            return false;
        }
        return true;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}