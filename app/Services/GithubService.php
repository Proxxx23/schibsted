<?php declare(strict_types=1);

namespace App\Services;

use App\Objects\Commands\RepositoryDetailedStatisticsCommand;
use App\Objects\DTO\RepositoryDetailsDTO;
use App\Objects\DTO\UserRepositoryDTO;
use App\Objects\DTO\UserRepositoryDTOCollection;
use App\Objects\DTO\ValidatorInterface;
use App\Repositories\GithubRepository;
use function Couchbase\defaultDecoder;

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
     * @param RepositoryDetailedStatisticsCommand $repositoryDetailedStatisticsCommand
     * @return RepositoryDetailsDTO
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function getRepositoryDetailedStatistics(
        RepositoryDetailedStatisticsCommand $repositoryDetailedStatisticsCommand
    ): RepositoryDetailsDTO
    {
        $watchersStarsDates = $this->repository
            ->getStarsAndWatchersStatistics($repositoryDetailedStatisticsCommand);

        $pullsAndForks = $this->repository
            ->getPullsAndForksStatistics($repositoryDetailedStatisticsCommand);

        return new RepositoryDetailsDTO(
            $watchersStarsDates,
            $pullsAndForks
        );
    }

}