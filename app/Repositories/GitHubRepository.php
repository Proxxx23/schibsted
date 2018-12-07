<?php declare(strict_types=1);

namespace App\Repositories;

use App\Objects\DTO\UserDetailsDTO;
use App\Objects\DTO\UserRepositoryDTO;
use App\Objects\DTO\UserRepositoryDTOCollection;
use App\Objects\Queries\DetailedStatisticsQuery;
use App\Objects\DTO\PullStatisticsDTO;
use App\Objects\DTO\DetailedStatisticsDTO;

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
     * Completes data about stars, watchers, forks count and repository last update date
     *
     * @param DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
     * @return DetailedStatisticsDTO
     */
    public function getRepositoryDetailedInfo(
        DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
    ): DetailedStatisticsDTO
    {
        $username = $repositoryDetailedStatisticsCommand->getUsername();
        $repositoryName = $repositoryDetailedStatisticsCommand->getRepositoryName();

        $details = $this->github->api('repos')->show($username, $repositoryName);

        return new DetailedStatisticsDTO($details);
    }

    /**
     * Completes data about pull and forks count
     *
     * @param DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
     * @return PullStatisticsDTO
     */
    public function getPullRequestsCount(
        DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
    ): PullStatisticsDTO
    {
        $username = $repositoryDetailedStatisticsCommand->getUsername();
        $repositoryName = $repositoryDetailedStatisticsCommand->getRepositoryName();

        $openPullRequestsCount = $this->getOpenPullRequestsCount($username, $repositoryName);
        $closedPullRequestsCount = $this->getClosedPullRequestsCount($username, $repositoryName);

        return new PullStatisticsDTO($openPullRequestsCount, $closedPullRequestsCount);
    }

    /**
     * Returns open pull requests count
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
     * Returns closed pull requests count
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
}