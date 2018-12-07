<?php declare(strict_types=1);

namespace App\Objects\DTO;

use App\Objects\SimpleObjects\PullsAndForks;
use App\Objects\SimpleObjects\StarsAndDates;

/**
 * Class RepositoryDetailsDTO
 * @package App\Objects\DTO
 */
final class RepositoryDetailsDTO implements ResponseInterface
{

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $repositoryName
     */
    private $repositoryName;

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
        PullsAndForks $pullsAndForks,
        string $username,
        string $repositoryName
    )
    {
        $this->username = $username;
        $this->repositoryName = $repositoryName;
        $this->forksCount = $pullsAndForks->getForks();
        $this->openPullRequestsCount = $pullsAndForks->getOpenPullRequests();
        $this->closedPullRequestsCount = $pullsAndForks->getClosedPullRequests();
        $this->starsCount = $starsAndDates->getStarsCount();
        $this->watchersCount = $starsAndDates->getWatchersCount();
        $this->latestReleaseDate = $starsAndDates->getUpdatedAt();
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return $this->repositoryName;
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
            'username' => $this->username,
            'repositoryName' => $this->repositoryName,
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

}