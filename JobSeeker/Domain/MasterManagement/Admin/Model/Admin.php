<?php

namespace JobSeeker\Domain\MasterManagement\Admin\Model;

use JobSeeker\Domain\Base\BaseDomainModel;
use Carbon\Carbon;

class Admin extends BaseDomainModel
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var int|null
     */
    private ?int $referredBy;
    /**
     * @var int
     */
    private int $status;
    /**
     * @var string
     */
    private string $ipAddress;
    /**
     * @var Carbon|null
     */
    private ?Carbon $lastLogin;
    /**
     * @var string|null
     */
    private ?string $rememberToken;

    /**
     * Admin constructor.
     *
     * @param string      $name
     * @param string      $email
     * @param string      $password
     * @param Carbon|null $lastLogin
     * @param string|null $rememberToken
     */
    public function  __construct(
        string $name,
        string $email,
        string $password,
        ?Carbon $lastLogin = null,
        ?string $rememberToken = null
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->lastLogin = $lastLogin;
        $this->rememberToken = $rememberToken;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int|null
     */
    public function getReferredBy(): ?int
    {
        return $this->referredBy;
    }

    /**
     * @param int|null $referredBy
     */
    public function setReferredBy(?int $referredBy): void
    {
        $this->referredBy = $referredBy;
    }

    /**
     * @return Carbon|null
     */
    public function getLastLogin(): ?Carbon
    {
        return $this->lastLogin ?? null;
    }

    /**
     * @param Carbon|null $lastLogin
     */
    public function setLastLogin(?Carbon $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return $this->rememberToken ?? null;
    }

    /**
     * @param string|null $rememberToken
     */
    public function setRememberToken(?string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }
}
