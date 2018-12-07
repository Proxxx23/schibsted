<?php declare(strict_types=1);

namespace App\Objects\DTO;

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

    /**
     * RepositoryDetailsDTO constructor.
     * @param string $username
     * @param string $repositoryName
     * @param DetailedStatisticsDTO $detailedStatisticsDTO
     * @param PullStatisticsDTO $pullStatisticsDTO
     */
    public function __construct(
        string $username,
        string $repositoryName,
        DetailedStatisticsDTO $detailedStatisticsDTO,
        PullStatisticsDTO $pullStatisticsDTO
    ) {
        $this->username = $username;
        $this->repositoryName = $repositoryName;
        $this->forksCount = $detailedStatisticsDTO->getForksCount();
        $this->starsCount = $detailedStatisticsDTO->getStarsCount();
        $this->watchersCount = $detailedStatisticsDTO->getWatchersCount();
        $this->openPullRequestsCount = $pullStatisticsDTO->getOpenPullRequests();
        $this->closedPullRequestsCount = $pullStatisticsDTO->getClosedPullRequests();
        $this->latestReleaseDate = $detailedStatisticsDTO->getUpdatedAt();
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
            'openPullRequestsCount' => $this->openPullRequestsCount,
            'closedPullRequestsCount' => $this->closedPullRequestsCount,
            'latestReleaseDate' => $this->latestReleaseDate,
        ];
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}