<?php declare(strict_types=1);

namespace App\Services;

use App\Objects\DTO\UserDetailsDTO;
use App\Objects\Queries\DetailedStatisticsQuery;
use App\Objects\Queries\DetailedStatisticsQueryCollection;
use App\Objects\DTO\RepositoryComparisonDTO;
use App\Objects\DTO\RepositoryDetailsDTO;
use App\Objects\DTO\RepositoryDetailsDTOCollection;
use App\Objects\DTO\UserRepositoryDTOCollection;
use App\Repositories\GitHubRepository;

/**
 * Class GitHubService
 * @package App\Services
 */
final class GitHubService
{
    /**
     * @var GitHubRepository $repository
     */
    private $repository;

    /**
     * @var StatisticsCounter $statistics
     */
    private $statistics;

    /**
     * GitHubService constructor.
     * @param GitHubRepository $githubRepository
     * @param StatisticsCounter $statisticsCounter
     */
    public function __construct(
        GitHubRepository $githubRepository,
        StatisticsCounter $statisticsCounter
    ) {
        $this->repository = $githubRepository;
        $this->statistics = $statisticsCounter;
    }

    /**
     * Returns user details
     *
     * @param string $gitHubUser
     * @return UserDetailsDTO
     */
    public function getUserDetails(string $gitHubUser): UserDetailsDTO
    {
        return $this->repository->getUserDetails($gitHubUser);
    }

    /**
     * Returns user repositories list
     *
     * @param string $gitHubUser
     * @return UserRepositoryDTOCollection
     */
    public function getUserRepositoriesList(string $gitHubUser): UserRepositoryDTOCollection
    {
        return $this->repository->getUserRepositoriesList($gitHubUser);
    }

    /**
     * Returns given repository detailed statistics
     *
     * @param DetailedStatisticsQuery $detailedStatisticsCommand
     * @return RepositoryDetailsDTO
     */
    public function getRepositoryDetailedStatistics(
        DetailedStatisticsQuery $detailedStatisticsCommand
    ): RepositoryDetailsDTO {
        $detailedInfo = $this->repository
            ->getRepositoryDetailedInfo($detailedStatisticsCommand);
        $pullRequestsCount = $this->repository
            ->getPullRequestsCount($detailedStatisticsCommand);

        $username = $detailedStatisticsCommand->getUsername();
        $repositoryName = $detailedStatisticsCommand->getRepositoryName();

        return new RepositoryDetailsDTO(
            $username,
            $repositoryName,
            $detailedInfo,
            $pullRequestsCount
        );
    }

    /**
     * Returns data about two repositories along with their comparison details
     *
     * @param DetailedStatisticsQueryCollection $detailedStatisticsQueryCollection
     * @return RepositoryDetailsDTOCollection
     * @throws \App\Exceptions\InvalidCollectionTypeException
     * @throws \Exception
     */
    public function getRepositoriesComparedStatistics(
        DetailedStatisticsQueryCollection $detailedStatisticsQueryCollection
    ): RepositoryDetailsDTOCollection {
        $repositoryDetailsDTOCollection = new RepositoryDetailsDTOCollection();
        foreach ($detailedStatisticsQueryCollection->getCollectionElements() as $repoData) {
            $repositoryDetailsDTO = $this->getRepositoryDetailedStatistics($repoData);
            $repositoryDetailsDTOCollection->addCollectionElement($repositoryDetailsDTO);
        }

        $repositoryComparisonDTO = $this->completeComparisonData($repositoryDetailsDTOCollection);
        $repositoryDetailsDTOCollection->setComparisonData($repositoryComparisonDTO);

        return $repositoryDetailsDTOCollection;
    }

    /**
     * Completes comparison data
     *
     * @param RepositoryDetailsDTOCollection $repositoryDetailsDTOCollection
     * @return RepositoryComparisonDTO
     * @throws \Exception
     */
    private function completeComparisonData(
        RepositoryDetailsDTOCollection $repositoryDetailsDTOCollection
    ): RepositoryComparisonDTO {
        [$firstRepo, $secondRepo] = $repositoryDetailsDTOCollection->getCollectionElements();

        $starsCompared = $this->statistics->compareStarsNumber($firstRepo, $secondRepo);
        $forksCompared = $this->statistics->compareForksNumber($firstRepo, $secondRepo);
        $openPullRequestsCompared = $this->statistics->compareOpenPullRequestsNumber($firstRepo, $secondRepo);
        $closedPullRequestsCompared = $this->statistics->compareClosedPullRequestsNumber($firstRepo, $secondRepo);
        $watchersCompared = $this->statistics->compareWatchersNumber($firstRepo, $secondRepo);
        $datesCompared = $this->statistics->compareLatestReleaseDates($firstRepo, $secondRepo);

        return new RepositoryComparisonDTO(
            $starsCompared,
            $forksCompared,
            $watchersCompared,
            $openPullRequestsCompared,
            $closedPullRequestsCompared,
            $datesCompared
        );
    }
}