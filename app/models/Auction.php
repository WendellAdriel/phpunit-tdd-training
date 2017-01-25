<?php
declare(strict_types=1);

namespace Auction\Models;

use Auction\ValueObjects\Description;
use Auction\ValueObjects\Price;

class Auction
{
    const BID_PRICE_MINIMUM_DIFFERENCE = 1;
    
    /** @var Description */
    private $description;

    /** @var \DateTime */
    private $startDate;

    /** @var \DateTime */
    private $endDate;

    /** @var User */
    private $seller;

    /** @var Price */
    private $startingPrice;

    /** @var array */
    private $bids;

    /**
     * Auction constructor.
     * @param Description $description
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param User $seller
     * @param Price $startingPrice
     */
    public function __construct(Description $description, \DateTime $startDate, \DateTime $endDate, User $seller, Price $startingPrice)
    {
        $this->description   = $description;
        $this->startDate     = $startDate;
        $this->endDate       = $endDate;
        $this->seller        = $seller;
        $this->startingPrice = $startingPrice;
        $this->bids          = [];
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->description;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @return User
     */
    public function getSeller(): User
    {
        return $this->seller;
    }

    /**
     * @return float
     */
    public function getStartingPrice(): float
    {
        return $this->startingPrice->getPrice();
    }

    /**
     * @return array
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * Add new bid
     *
     * @param Bid $bid
     *
     * @throws \Exception
     */
    public function addBid(Bid $bid)
    {
        if (!$this->isValid($bid)) {
            throw new \Exception('Bid is invalid');
        }
        $this->bids[] = $bid;
    }

    /**
     * Returns true if bid is valid
     *
     * @param Bid $bid
     * @return bool
     */
    private function isValid(Bid $bid): bool
    {
        try {
            $this->validateBidPrice($bid);
            $this->validateBidUser($bid);
        } catch (\Exception $ex) {
           return false;
        }

        return true;
    }

    /**
     * Validates bid price. Throws exception if not valid
     *
     * @param Bid $bid
     * @throws \Exception
     */
    private function validateBidPrice(Bid $bid)
    {
        if (count($this->getBids()) == 0) {
            if ($bid->getBidPrice() < $this->getStartingPrice()) {
                throw new \Exception('Bid has price inferior to starting price');
            }
            return;
        }

        if ($bid->getBidPrice() - $this->getBids()[count($this->getBids()) -1]->getBidPrice() < self::BID_PRICE_MINIMUM_DIFFERENCE) {
            throw new \Exception('Bid has not a valid minimum price');
        }
    }

    /**
     * Validates bid user. Throws exception if not valid
     *
     * @param Bid $bid
     * @throws \Exception
     */
    private function validateBidUser(Bid $bid)
    {
        if ($bid->getUser() == $this->getSeller()) {
            throw new \Exception('Bid user cannot be the same user of the auction');
        }
    }
}