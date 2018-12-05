<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

/**
 * Class StarsAndDates
 * @package App\Objects\SimpleObjects
 */
final class StarsAndDates
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
     * @var string $updatedAt
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getStarsCount(): int
    {
        return $this->starsCount;
    }

    /**
     * @param int $starsCount
     * @return StarsAndDates
     */
    public function setStarsCount(int $starsCount): StarsAndDates
    {
        $this->starsCount = $starsCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getWatchersCount(): int
    {
        return $this->watchersCount;
    }

    /**
     * @param int $watchersCount
     * @return StarsAndDates
     */
    public function setWatchersCount(int $watchersCount): StarsAndDates
    {
        $this->watchersCount = $watchersCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->formatDate($this->updatedAt);
    }

    /**
     * @param string $updatedAt
     * @return StarsAndDates
     */
    public function setUpdatedAt(string $updatedAt): StarsAndDates
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param string $date
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public function formatDate(string $date, $format = 'Y-m-d H:i:s')
    {
        $dateObject = new \DateTime($date);
        return $dateObject->format($format);
    }

}