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
     * @var int $forksNumber
     */
    private $forksNumber;

    /**
     * @var int $starsNumber
     */
    private $starsNumber;

    /**
     * @var int $watchersNumber
     */
    private $watchersNumber;

    /**
     * @var string $latestReleaseDate
     */
    private $latestReleaseDate;

    /**
     * @var int $openPullRequestsNumber
     */
    private $openPullRequestsNumber;

    /**
     * @var int $closedPullRequestsNumber
     */
    private $closedPullRequestsNumber;

    /**
     * RepositoryDetailsDTO constructor.
     * @param StarsAndDates $starsAndDates
     * @param PullsAndForks $pullsAndForks
     * @param string $username
     * @param string $repositoryName
     */
    public function __construct(
        StarsAndDates $starsAndDates,
        PullsAndForks $pullsAndForks,
        string $username,
        string $repositoryName
    ) {
        $this->username = $username;
        $this->repositoryName = $repositoryName;
        $this->forksNumber = $pullsAndForks->getForks();
        $this->openPullRequestsNumber = $pullsAndForks->getOpenPullRequests();
        $this->closedPullRequestsNumber = $pullsAndForks->getClosedPullRequests();
        $this->starsNumber = $starsAndDates->getStarsCount();
        $this->watchersNumber = $starsAndDates->getWatchersCount();
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
    public function getForksNumber(): int
    {
        return $this->forksNumber;
    }

    /**
     * @return int
     */
    public function getStarsNumber(): int
    {
        return $this->starsNumber;
    }

    /**
     * @return int
     */
    public function getWatchersNumber(): int
    {
        return $this->watchersNumber;
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
    public function getOpenPullRequestsNumber(): int
    {
        return $this->openPullRequestsNumber;
    }

    /**
     * @return int
     */
    public function getClosedPullRequestsNumber(): int
    {
        return $this->closedPullRequestsNumber;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'repositoryName' => $this->repositoryName,
            'forksNumber' => $this->forksNumber,
            'starsNumber' => $this->starsNumber,
            'watchersNumber' => $this->watchersNumber,
            'latestReleaseDate' => $this->latestReleaseDate,
            'openPullRequestsNumber' => $this->openPullRequestsNumber,
            'closedPullRequestsNumber' => $this->closedPullRequestsNumber,
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