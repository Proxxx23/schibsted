<?php declare(strict_types=1);

namespace App\Repositories;

use App\Objects\DTO\UserDetailsDTO;
use App\Objects\DTO\UserRepositoryDTO;
use App\Objects\DTO\UserRepositoryDTOCollection;
use App\Objects\Queries\DetailedStatisticsQuery;
use App\Objects\SimpleObjects\PullsAndForks;
use App\Objects\SimpleObjects\StarsAndDates;

/**
 * Class GitHubRepository
 * @package App\Repositories
 */
final class GitHubRepository
{
    /** @var \Github\Client $github */
    private $github;

    /**
     * GitHubRepository constructor.
     */
    public function __construct()
    {
        $this->github = new \Github\Client();
    }

    /**
     * Returns information about Github user
     *
     * @param string $gitHubUser
     * @return UserDetailsDTO
     */
    public function getUserDetails(string $gitHubUser): UserDetailsDTO
    {
        $user = $this->github->api('user')->show($gitHubUser);
        return new UserDetailsDTO($user);
    }

    /**
     * Returns user's repositories list
     *
     * @param string $gitHubUser
     * @return UserRepositoryDTOCollection
     */
    public function getUserRepositoriesList(string $gitHubUser): UserRepositoryDTOCollection
    {
        $repositories = $this->github->api('user')->repositories($gitHubUser);

        $userRepositoryDTOCollection = new UserRepositoryDTOCollection();
        foreach ($repositories as &$repository) {
            $userRepositoryDTO = new UserRepositoryDTO($repository);
            $userRepositoryDTOCollection->addCollectionElement($userRepositoryDTO);
        }
        unset($repository);

        return $userRepositoryDTOCollection;
    }

    /**
     * Completes data about stars number, watchers number and repository last update date
     *
     * @param DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
     * @return StarsAndDates
     */
    public function getStarsWatchersAndDateStatistics(
        DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
    ): StarsAndDates
    {
        $username = $repositoryDetailedStatisticsCommand->getUsername();
        $repositoryName = $repositoryDetailedStatisticsCommand->getRepositoryName();

        $details = $this->github->api('repos')->show($username, $repositoryName);

        return (new StarsAndDates())
            ->setStarsCount($details['stargazers_count'])
            ->setWatchersCount($details['watchers_count'])
            ->setUpdatedAt($details['updated_at']);
    }

    /**
     * Completes data about pull and forks number
     *
     * @param DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
     * @return PullsAndForks
     */
    public function getPullsAndForksStatistics(
        DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
    ): PullsAndForks
    {
        $username = $repositoryDetailedStatisticsCommand->getUsername();
        $repositoryName = $repositoryDetailedStatisticsCommand->getRepositoryName();

        $openPullRequestsCount = $this->getOpenPullRequestsCount($username, $repositoryName);
        $closedPullRequestsCount = $this->getClosedPullRequestsCount($username, $repositoryName);
        $forksCount = $this->getForksCount($username, $repositoryName);

        return (new PullsAndForks)
            ->setOpenPullRequests($openPullRequestsCount)
            ->setClosedPullRequests($closedPullRequestsCount)
            ->setForks($forksCount);
    }

    /**
     * Returns open pull requests number
     *
     * @param string $username
     * @param string $repositoryName
     * @return int
     */
    private function getOpenPullRequestsCount(string $username, string $repositoryName): int
    {
        return count($this->github->api('pull_request')
            ->all($username, $repositoryName, [
                'state' => 'open'
            ]));
    }

    /**
     * Returns closed pull requests number
     *
     * @param string $username
     * @param string $repositoryName
     * @return int
     */
    private function getClosedPullRequestsCount(string $username, string $repositoryName): int
    {
        return count($this->github->api('pull_request')
            ->all($username, $repositoryName, [
                'state' => 'closed'
            ]));
    }

    /**
     * Returns forks number
     *
     * @param string $username
     * @param string $repositoryName
     * @return int
     */
    private function getForksCount(string $username, string $repositoryName): int
    {
        return count($this->github->api('repo')
            ->forks()
            ->all($username, $repositoryName));
    }
}