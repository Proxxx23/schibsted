<?php declare(strict_types=1);

namespace App\Repositories;

use App\Objects\Commands\DetailedStatisticsQuery;
use App\Objects\SimpleObjects\PullsAndForks;
use App\Objects\SimpleObjects\StarsAndDates;

/**
 * Class GithubRepository
 * @package App\Repositories
 */
final class GithubRepository
{
    /** @var \Github\Client $github */
    private $github;

    /**
     * GithubRepository constructor.
     */
    public function __construct()
    {
        $this->github = new \Github\Client();
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