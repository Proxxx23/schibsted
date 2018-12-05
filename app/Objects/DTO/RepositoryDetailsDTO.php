<?php declare(strict_types=1);

namespace App\Objects\DTO;

use App\Objects\SimpleObjects\PullsAndForks;
use App\Objects\SimpleObjects\StarsAndDates;

/**
 * Class RepositoryDetailsDTO
 * @package App\Objects\DTO
 */
final class RepositoryDetailsDTO implements ValidatorInterface
{

    /**
     * @var int $forksCount
     */
    private $forksCount;

    /**
     * @var int $starsCount
     */
    private $starsCount;

    /**
     * @var int $watchersCount
     */
    private $watchersCount;

    /**
     * @var string $latestReleaseDate
     */
    private $latestReleaseDate;

    /**
     * @var int $openPullRequestsCount
     */
    private $openPullRequestsCount;

    /**
     * @var int $closedPullRequestsCount
     */
    private $closedPullRequestsCount;


    public function __construct(
        StarsAndDates $starsAndDates,
        PullsAndForks $pullsAndForks
    )
    {
        $this->forksCount = $pullsAndForks->getForks();
        $this->openPullRequestsCount = $pullsAndForks->getOpenPullRequests();
        $this->closedPullRequestsCount = $pullsAndForks->getClosedPullRequests();
        $this->starsCount = $starsAndDates->getStarsCount();
        $this->watchersCount = $starsAndDates->getWatchersCount();
        $this->latestReleaseDate = $starsAndDates->getUpdatedAt();
    }

    /**
     * @return int
     */
    public function getForksCount(): int
    {
        return $this->forksCount;
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
     * @return string
     */
    public function getLatestReleaseDate(): string
    {
        return $this->latestReleaseDate;
    }

    /**
     * @return int
     */
    public function getOpenPullRequestsCount(): int
    {
        return $this->openPullRequestsCount;
    }

    /**
     * @return int
     */
    public function getClosedPullRequestsCount(): int
    {
        return $this->closedPullRequestsCount;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'forksCount' => $this->forksCount,
            'starsCount' => $this->starsCount,
            'watchersCount' => $this->watchersCount,
            'latestReleaseDate' => $this->latestReleaseDate,
            'openPullRequestsCount' => $this->openPullRequestsCount,
            'closedPullRequestsCount' => $this->closedPullRequestsCount,
        ];
    }

    /**
     * @return string|null
     */
    public function toJson(): ?string
    {
        return json_encode($this->toArray());
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return !(empty($this->toArray()));
    }
}