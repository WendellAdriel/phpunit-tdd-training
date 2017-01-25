<?php
declare(strict_types=1);

namespace Auction\ValueObjects;

class Description
{
    const MIN_DESCRIPTION_LENGTH = 10;

    /** @var string */
    private $description;

    /**
     * Description constructor.
     * @param string $description
     */
    public function __construct(string $description)
    {
        if ($this->isValid($description)) {
            $this->description = $description;
            return;
        }
        throw new \InvalidArgumentException("Description is invalid");
    }

    /**
     * @param string $description
     * @return bool
     */
    private function isValid(string $description): bool
    {
        if (strlen($description) < self::MIN_DESCRIPTION_LENGTH) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->description;
    }
}