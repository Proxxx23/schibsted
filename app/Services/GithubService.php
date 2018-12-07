<?php declare(strict_types=1);

namespace App\Services;

use App\ApiConst;
use App\Objects\Commands\DetailedStatisticsQuery;
use App\Objects\Commands\DetailedStatisticsQueryCollection;
use App\Objects\DTO\RepositoryComparisonDTO;
use App\Objects\DTO\RepositoryDetailsDTO;
use App\Objects\DTO\RepositoryDetailsDTOCollection;
use App\Objects\DTO\UserRepositoryDTOCollection;
use App\Objects\SimpleObjects\BasicComparison;
use App\Objects\SimpleObjects\ForksComparison;
use App\Objects\SimpleObjects\NumberComparison;
use App\Objects\SimpleObjects\StarsComparison;
use App\Objects\SimpleObjects\WatchersComparison;
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
     * Pobiera listę repozytoriów użytkownika
     *
     * @param string $gitHubUser
     * @return UserRepositoryDTOCollection
     */
    public function getUserRepositoriesList(string $gitHubUser): UserRepositoryDTOCollection
    {
        //
    }

    /**
     * Zwraca dane dotyczące konkretnego repozytorium użytkownika
     *
     * @param DetailedStatisticsQuery $detailedStatisticsCommand
     * @return RepositoryDetailsDTO
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function getRepositoryDetailedStatistics
    (
        DetailedStatisticsQuery $detailedStatisticsCommand
    ): RepositoryDetailsDTO
    {
        $watchersStarsDates = $this->repository
            ->getStarsAndWatchersStatistics($detailedStatisticsCommand);
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
     * Zwraca dane porównawcze dwóch repozytoriów
     *
     * @param DetailedStatisticsQueryCollection $detailedStatisticsQueryCollection
     * @return RepositoryComparisonDTO
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function getRepositoriesComparedStatistics
    (
        DetailedStatisticsQueryCollection $detailedStatisticsQueryCollection
    ): RepositoryComparisonDTO
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
     * @param RepositoryDetailsDTOCollection $repositoryDetailsDTOCollection
     * @return RepositoryComparisonDTO
     */
    private function completeComparisonData
    (
        RepositoryDetailsDTOCollection $repositoryDetailsDTOCollection
    ): RepositoryComparisonDTO
    {
        $firstRepo = $repositoryDetailsDTOCollection->getCollectionElements()[0];
        $secondRepo = $repositoryDetailsDTOCollection->getCollectionElements()[1];

        $starsCompared = $this->statistics->compareStarsCount($firstRepo, $secondRepo);
        $forksCompared = $this->statistics->compareForksCount($firstRepo, $secondRepo);
        $openPullRequestsCompared = $this->statistics->compareOpenPullRequests($firstRepo, $secondRepo);
        $closedPullRequestsCompared = $this->statistics->compareClosedPullRequests($firstRepo, $secondRepo);
        $watchersCompared = $this->statistics->compareWatchersCount($firstRepo, $secondRepo);
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