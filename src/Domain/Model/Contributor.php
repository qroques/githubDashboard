<?php

namespace App\Domain\Model;

class Contributor
{
    private int $contributions;

    private string $login;

    private string $avatar;

    private string $profile;

    public function __construct(string $login, string $avatar, string $profile)
    {
        $this->login = $login;
        $this->avatar = $avatar;
        $this->profile = $profile;
        $this->contributions = 0;
    }

    public function addContributions(int $contributions)
    {
        $this->contributions += $contributions;
    }

    public function getContributions(): int
    {
        return $this->contributions;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function __toString(): string
    {
        return $this->getLogin();
    }

    public function getAvatar(): mixed
    {
        return $this->avatar;
    }

    public function getProfile(): mixed
    {
        return $this->profile;
    }
}
