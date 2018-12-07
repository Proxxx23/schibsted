<?php declare(strict_types=1);

namespace App\Repositories;

use App\Objects\Commands\DetailedStatisticsQuery;
use App\Objects\DTO\RepositoryDetailsDTO;
use App\Objects\DTO\UserRepositoryDTO;
use App\Objects\DTO\UserRepositoryDTOCollection;
use App\Objects\SimpleObjects\PullRequests;
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
     * Pobiera liczbę gwiazdek, liczbę watcherów i datę ostatniej aktualizacji repo
     *
     * @param DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
     * @return StarsAndDates
     */
    public function getStarsAndWatchersStatistics(
        DetailedStatisticsQuery $repositoryDetailedStatisticsCommand
    ): StarsAndDates
    {
        $username = $repositoryDetailedStatisticsCommand->getUsername();
        $repositoryName = $repositoryDetailedStatisticsCommand->getRepositoryName();

        $details = $this->github->api('repos')->show($username, $repositoryName);
        if (empty($details)) {
            //TODO: Jak to obsługiwać wyżej?
        }

        return (new StarsAndDates())
            ->setStarsCount($details['stargazers_count'])
            ->setWatchersCount($details['watchers_count'])
            ->setUpdatedAt($details['updated_at']);
    }

    /**
     * Pobiera daneo pullach (open/closed) i forksach
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