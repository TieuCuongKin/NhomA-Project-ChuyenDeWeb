<?php

namespace JobSeeker\Domain\JobSeekerManagement\User\Model;

use JobSeeker\Domain\Base\BaseDomainModel;

class User extends BaseDomainModel
{
    /**
     * @var string
     */
    private string $fullName;

    /**
     * @var int
     */
    private int $gender;

    /**
     * @var string
     */
    private string $address;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;


    /**
     * @var int
     */
    private int $status;

    /**
     * @var int
     */
    private int $user_type_id;

    /**
     * @var string|null
     */
    private ?string $rememberToken;

    /**
     * @param string $fullName
     * @param int $gender
     * @param string $address
     * @param string $phone
     * @param string $email
     * @param string $password
     * @param int $status
     * @param int $user_type_id
     * @param string|null $rememberToken
     */
    public function __construct(
        string $fullName,
        int $gender,
        string $address,
        string $phone,
        string $email,
        string $password,
        int $status,
        int $user_type_id,
        ?string $rememberToken
    ) {
        $this->fullName = $fullName;
        $this->gender = $gender;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->user_type_id = $user_type_id;
        $this->rememberToken = $rememberToken;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getUserTypeId(): int
    {
        return $this->user_type_id;
    }

    /**
     * @param int $user_type_id
     */
    public function setUserTypeId(int $user_type_id): void
    {
        $this->user_type_id = $user_type_id;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return int
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     */
    public function setGender(int $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
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
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    /**
     * @param string|null $rememberToken
     */
    public function setRememberToken(?string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }
}