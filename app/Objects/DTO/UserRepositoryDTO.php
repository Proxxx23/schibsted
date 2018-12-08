<?php declare(strict_types=1);

namespace App\Objects\DTO;

/**
 * Class UserRepositoryDTO
 * @package App\Objects\DTO
 */
final class UserRepositoryDTO implements ResponseInterface
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
     * @var int $watchersCount
     */
    private $watchersCount;

    /**
     * @var int $starsCount
     */
    private $starsCount;

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
        $this->watchersCount = $data['watchers_count'];
        $this->starsCount = $data['stargazers_count'];
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
     * @return int
     */
    public function getWatchersCount(): int
    {
        return $this->watchersCount;
    }

    /**
     * @return int
     */
    public function getStarsCount(): int
    {
        return $this->starsCount;
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
            'watchersCount' => $this->watchersCount,
            'starsCount' => $this->starsCount,
            'createdAt' => $this->formatDate($this->createdAt),
            'updatedAt' => $this->formatDate($this->updatedAt),
        ];
    }

    /**
     * Formats date
     *
     * @param string $date
     * @param string $format
     * @return string
     * @throws \Exception
     */
    private function formatDate(string $date, $format = 'Y-m-d H:i:s')
    {
        $dateObject = new \DateTime($date);
        return $dateObject->format($format);
    }
}