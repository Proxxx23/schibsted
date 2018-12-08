<?php declare(strict_types=1);

namespace App\Objects\DTO;

/**
 * Class DetailedStatisticsDTO
 * @package App\Objects\DTO
 */
final class DetailedStatisticsDTO
{

    /**
     * @var int $starsCount
     */
    private $starsCount;

    /**
     * @var int $watchersCount
     */
    private $watchersCount;

    /**
     * @var int $forksCount
     */
    private $forksCount;

    /**
     * @var string $updatedAt
     */
    private $updatedAt;

    /**
     * DetailedStatisticsDTO constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->starsCount = $data['stargazers_count'];
        $this->watchersCount = $data['subscribers_count'];
        $this->forksCount = $data['forks_count'];
        $this->updatedAt = $data['updated_at'];
    }

    /**
     * @return int
     */
    public function getStarsCount(): int
    {
        return $this->starsCount;
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
    public function getForksCount(): int
    {
        return $this->forksCount;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->formatDate($this->updatedAt);
    }

    /**
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