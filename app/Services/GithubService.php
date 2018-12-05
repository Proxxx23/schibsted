<?php declare(strict_types=1);

namespace App\Services;

use App\Objects\Commands\DetailedStatisticsCommand;
use App\Objects\Commands\DetailedStatisticsCommandCollection;
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

    /** @var GithubRepository $repository */
    private $repository;

    /**
     * GithubService constructor.
     * @param GithubRepository $githubRepository
     */
    public function __construct(GithubRepository $githubRepository)
    {
        $this->repository = $githubRepository;
    }

    public function getUserRepositoriesList(string $gitHubUser): UserRepositoryDTOCollection
    {
        return $this->repository->getStarsAndWatchersStatistics($gitHubUser);
    }

    /**
     * Zwraca dane dotyczące konkretnego repozytorium użytkownika
     *
     * @param DetailedStatisticsCommand $detailedStatisticsCommand
     * @return RepositoryDetailsDTO
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function getRepositoryDetailedStatistics(
        DetailedStatisticsCommand $detailedStatisticsCommand
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
     * @param DetailedStatisticsCommandCollection $detailedStatisticsCommandCollection
     * @return RepositoryDetailsDTOCollection
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function getComparedRepositoriesStatistics(
        DetailedStatisticsCommandCollection $detailedStatisticsCommandCollection
    ): RepositoryDetailsDTOCollection
    {

        $repositoryDetailsDTOCollection = new RepositoryDetailsDTOCollection();
        foreach($detailedStatisticsCommandCollection->getCollectionElements() as $repoData) {
            $repositoryDetailsDTO = $this->getRepositoryDetailedStatistics($repoData);
            $repositoryDetailsDTOCollection->addCollectionElement($repositoryDetailsDTO);
        }

        return $repositoryDetailsDTOCollection;

    }
}