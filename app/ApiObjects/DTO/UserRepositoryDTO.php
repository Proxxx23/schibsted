<?php declare(strict_types=1);

namespace App\ApiObjects\DTO;

/**
 * Class UserRepositoryDTO
 * @package App\ApiObjects\DTO
 */
final class UserRepositoryDTO
{

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var string $createdAt
     */
    private $createdAt;

    /**
     * @var string $updatedAt
     */
    private $updatedAt;

    /**
     * UserRepositoryDTO constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->url = $data['html_url'];
        $this->description = $data['description'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}