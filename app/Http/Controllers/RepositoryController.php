<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\ApiConst;
use App\Objects\Common\ProblemResponse;
use App\Objects\Queries\DetailedStatisticsQuery;
use App\Objects\Queries\DetailedStatisticsQueryCollection;
use App\Repositories\GitHubRepository;
use App\Services\GitHubService;
use App\Services\StatisticsCounter;
use App\ValidationConst;
use Illuminate\Http\JsonResponse;

/**
 * Class RepositoryController
 * @package App\Http\Controllers
 */
final class RepositoryController extends Controller
{
    /**
     * Lists user public repositories
     *
     * @param string $gitHubUser
     * @return JsonResponse
     */
    public function listUserRepositories(string $gitHubUser): JsonResponse
    {
        if (strlen($gitHubUser) <= 1) {
            return $this->problemResponse(
                (new ProblemResponse())
                    ->setHttpCode(400)
                    ->setMessage(ValidationConst::INVALID_LENGTH)
            );
        }

        $service = new GitHubService(new GitHubRepository(), new StatisticsCounter());
        return $this->prepareResponse(
            $service->getUserRepositoriesList($gitHubUser)
        );
    }

    /**
     * Returns details about given repository
     *
     * @param string $username
     * @param string $repository
     * @return JsonResponse
     */
    public function repositoryDetails(string $username, string $repository): JsonResponse
    {
        $detailedStatisticsQuery = (new DetailedStatisticsQuery())
            ->setUsername($username)
            ->setRepositoryName($repository);

        if (null !== $detailedStatisticsQuery->validate()) {
            return $this->problemResponse($detailedStatisticsQuery->validate());
        }

        $repositoryService = new GitHubService(new GitHubRepository(), new StatisticsCounter());

        return $this->prepareResponse(
            $repositoryService->getRepositoryDetailedStatistics($detailedStatisticsQuery)
        );
    }

    /**
     * Returns compared data of two repositories
     *
     * @param string $firstSet
     * @param string $secondSet
     * @return JsonResponse
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function compareRepositories(string $firstSet, string $secondSet): JsonResponse
    {
        $firstRepository = explode(':', $firstSet);
        $secondRepository = explode(':', $secondSet);

        if (count($firstRepository) < 2 || count($secondRepository) < 2) {
            $problemResponse = (new ProblemResponse())
                ->setMessage(ApiConst::PROVIDE_WITH_COLON)
                ->setHttpCode(400);
            return $this->problemResponse($problemResponse);
        }

        [$firstUsername, $firstRepositoryName] = $firstRepository;
        [$secondUsername, $secondRepositoryName] = $secondRepository;

        $firstRepoStatisticsQuery = (new DetailedStatisticsQuery())
            ->setUsername($firstUsername)
            ->setRepositoryName($firstRepositoryName);

        if (null !== $firstRepoStatisticsQuery->validate()) {
            return $this->problemResponse($firstRepoStatisticsQuery->validate());
        }

        $secondRepoStatisticsQuery = (new DetailedStatisticsQuery())
            ->setUsername($secondUsername)
            ->setRepositoryName($secondRepositoryName);

        if (null !== $secondRepoStatisticsQuery->validate()) {
            return $this->problemResponse($secondRepoStatisticsQuery->validate());
        }

        $statisticsQueryCollection = new DetailedStatisticsQueryCollection();
        $statisticsQueryCollection->addCollectionElements(
            $firstRepoStatisticsQuery,
            $secondRepoStatisticsQuery
        );

        $repositoryService = new GitHubService(new GitHubRepository(), new StatisticsCounter());

        return $this->prepareResponse(
            $repositoryService->getRepositoriesComparedStatistics($statisticsQueryCollection)
        );
    }
}