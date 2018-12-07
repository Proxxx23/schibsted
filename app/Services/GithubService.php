<?php declare(strict_types=1);

namespace App\Services;

use App\Objects\Commands\DetailedStatisticsQuery;
use App\Objects\Commands\DetailedStatisticsQueryCollection;
use App\Objects\DTO\RepositoryComparisonDTO;
use App\Objects\DTO\RepositoryDetailsDTO;
use App\Objects\DTO\RepositoryDetailsDTOCollection;
use App\Objects\DTO\UserRepositoryDTOCollection;
use App\Repositories\GithubRepository;

/**
 * Class GithubService
 * @package App\Services
 */
final class GithubService
{
    /**
     * @var GithubRepository $repository
     */
    private $repository;

    /**
     * @var StatisticsCounter $statistics
     */
    private $statistics;

    /**
     * GithubService constructor.
     * @param GithubRepository $githubRepository
     * @param StatisticsCounter $statisticsCounter
     */
    public function __construct(
        GithubRepository $githubRepository,
        StatisticsCounter $statisticsCounter
    )
    {
        $this->repository = $githubRepository;
        $this->statistics = $statisticsCounter;
    }

    /**
     * Returns user repositories list
     *
     * @param string $gitHubUser
     * @return UserRepositoryDTOCollection
     */
    public function getUserRepositoriesList(string $gitHubUser): UserRepositoryDTOCollection
    {
        //
    }

    /**
     * Returns given repository detailed statistics
     *
     * @param DetailedStatisticsQuery $detailedStatisticsCommand
     * @return RepositoryDetailsDTO
     */
    public function getRepositoryDetailedStatistics
    (
        DetailedStatisticsQuery $detailedStatisticsCommand
    ): RepositoryDetailsDTO
    {
        $watchersStarsDates = $this->repository
            ->getStarsWatchersAndDateStatistics($detailedStatisticsCommand);
        $pullsAndForks = $this->repository
            ->getPullsAndForksStatistics($detailedStatisticsCommand);

        $username = $detailedStatisticsCommand->getUsername();
        $repositoryName = $detailedStatisticsCommand->getRepositoryName();

        return new RepositoryDetailsDTO(
            $watchersStarsDates,
            $pullsAndForks,
            $username,
            $repositoryName
        );
    }

    /**
     * Returns data about two repositories along with their comparison details
     *
     * @param DetailedStatisticsQueryCollection $detailedStatisticsQueryCollection
     * @return RepositoryDetailsDTOCollection
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function getRepositoriesComparedStatistics(
        DetailedStatisticsQueryCollection $detailedStatisticsQueryCollection
    ): RepositoryDetailsDTOCollection
    {
        $repositoryDetailsDTOCollection = new RepositoryDetailsDTOCollection();
        foreach($detailedStatisticsQueryCollection->getCollectionElements() as $repoData) {
            $repositoryDetailsDTO = $this->getRepositoryDetailedStatistics($repoData);
            $repositoryDetailsDTOCollection->addCollectionElement($repositoryDetailsDTO);
        }

        $repositoryComparisonDTO = $this->completeComparisonData($repositoryDetailsDTOCollection);
        $repositoryDetailsDTOCollection->setComparisonData($repositoryComparisonDTO);

        dd($repositoryDetailsDTOCollection);

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
    ): RepositoryComparisonDTO
    {
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