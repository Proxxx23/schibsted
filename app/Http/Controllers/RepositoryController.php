<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\ApiConst;
use App\Objects\Common\ProblemResponse;
use App\Objects\Queries\DetailedStatisticsQuery;
use App\Objects\Queries\DetailedStatisticsQueryCollection;
use App\Repositories\GithubRepository;
use App\Services\GithubService;
use App\Services\StatisticsCounter;
use App\ValidationConst;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function listUserRepositories(string $gitHubUser): Response
    {
        if (strlen($gitHubUser) <= 1) {
            return $this->problemResponse(
                (new ProblemResponse())
                    ->setHttpCode(400)
                    ->setMessage(ValidationConst::INVALID_LENGTH)
            );
        }

        $service = new GithubService(new GithubRepository(), new StatisticsCounter());
        return $this->prepareResponse(
            $service->getUserRepositoriesList($gitHubUser)
        );
    }

    /**
     * Returns details about given repository
     *
     * @param string $username
     * @param string $repository
     * @return Response
     */
    public function repositoryDetails(string $username, string $repository): Response
    {
        $detailedStatisticsCommand = (new DetailedStatisticsQuery())
            ->setUsername($username)
            ->setRepositoryName($repository);

        $repositoryService = new GithubService(new GithubRepository(), new StatisticsCounter());

        return $this->prepareResponse(
            $repositoryService->getRepositoryDetailedStatistics($detailedStatisticsCommand)
        );
    }

    /**
     * Returns compared data of two repositories
     *
     * @param string $firstSet
     * @param string $secondSet
     * @return Response
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function compareRepositories(string $firstSet, string $secondSet): Response
    {
        $firstRepository = explode(':', $firstSet);
        $secondRepository = explode(':', $secondSet);

        if (count($firstRepository) < 2 || count($secondRepository) < 2) {
            return new Response(ApiConst::PROVIDE_WITH_COLON, 400);
        }

        [$firstUsername, $firstRepositoryName] = $firstRepository;
        [$secondUsername, $secondRepositoryName] = $secondRepository;

        $firstRepoStatisticsQuery = (new DetailedStatisticsQuery())
            ->setUsername($firstUsername)
            ->setRepositoryName($firstRepositoryName);

        $secondRepoStatisticsQuery = (new DetailedStatisticsQuery())
            ->setUsername($secondUsername)
            ->setRepositoryName($secondRepositoryName);

        $statisticsQueryCollection = new DetailedStatisticsQueryCollection();
        $statisticsQueryCollection->addCollectionElements(
            $firstRepoStatisticsQuery,
            $secondRepoStatisticsQuery
        );

        $repositoryService = new GithubService(new GithubRepository(), new StatisticsCounter());

        return $this->prepareResponse(
            $repositoryService->getRepositoriesComparedStatistics($statisticsQueryCollection)
        );
    }
}