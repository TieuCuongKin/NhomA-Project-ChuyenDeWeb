<?php

namespace JobSeeker\Domain\Base;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

abstract class BaseDomainModel
{
    protected array $original = [];

    /**
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * @var Carbon|null
     */
    private ?Carbon $createdAt = null;

    /**
     * @var Carbon|null
     */
    private ?Carbon $updatedAt = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param Carbon|null $createdAt
     */
    public function setCreatedAt(?Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt ?? Carbon::now();
    }

    /**
     * @param Carbon|null $updatedAt
     */
    public function setUpdatedAt(?Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt ?? Carbon::now();
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt ?? Carbon::now();
    }

    /**
     * @param ?int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public function __call(string $method, array $parameters)
    {
        $property = $this->parseMethod($method);

        if (str_starts_with($method, 'get')) {

            return $this->$property;
        } elseif (str_starts_with($method, 'set') && isset($parameters[0])) {
            $this->$property = $parameters[0];

            return $this;
        }
        throw new Exception(__("Method $method not found!"));
    }

    /**
     * Parse magic method to corresponding property. E.g. getUserInfo -> userInfo
     *
     * @param string $method
     * @return string
     */
    private function parseMethod(string $method): string
    {
        return Str::camel(preg_replace('/^(get_|set_)/', '', preg_replace_callback('/([A-Z])/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $method), 1));
    }

    /**
     * @return array
     */
    public function getOriginal(): array
    {
        return $this->original;
    }

    /**
     * @param array $original
     */
    public function setOriginal(array $original): void
    {
        $this->original = $original;
    }
}
