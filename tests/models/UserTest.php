<?php

use PHPUnit\Framework\TestCase;
use Auction\Models\User;
use Auction\ValueObjects\Name;
use Auction\ValueObjects\Email;

class UserTest extends TestCase
{
    /** @var User */
    private $user;

    public function setUp()
    {
        $this->user = new User(new Name('John'), new Email('john@example.com'));
    }

    /**
     * @test
     */
    public function hasName()
    {
        $this->assertEquals('John', $this->user->getName());
    }

    /**
     * @test
     */
    public function hasEmail()
    {
        $this->assertEquals('john@example.com', $this->user->getEmail());
    }

    /**
     * @test
     */
    public function userHasUniqueEmail()
    {
        $emailList = $this->emailSuccessList();
        $this->assertTrue($this->user->isEmailUnique($emailList));
    }

    /**
     * @test
     */
    public function userHasNotUniqueEmail()
    {
        $emailList = array_merge($this->emailSuccessList(), $this->emailFailList());
        $this->assertNotTrue($this->user->isEmailUnique($emailList));
    }

    /**
     * @return array
     */
    private function emailSuccessList(): array
    {
        return ['user1@example.com', 'user2@example.com'];
    }

    /**
     * @return array
     */
    private function emailFailList(): array
    {
        return [$this->user->getEmail()];
    }
}
