<?php

declare(strict_types=1);

namespace InterviewTest;

class User
{
    private string $firstName = '';
    private string $lastName = '';
    private string $email = '';

    public function __construct(
        string $firstName = '',
        string $lastName = '',
        string $email = ''
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s %s <%s>', $this->firstName, $this->lastName, $this->email);
    }
}

$user = new User();
$user
    ->setFirstName('John')
    ->setLastName('Doe')
    ->setEmail('john.doe@example.com');
echo $user;

