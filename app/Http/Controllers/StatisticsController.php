<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\ApiConst;
use App\Objects\Commands\DetailedStatisticsQuery;
use App\Objects\Commands\DetailedStatisticsQueryCollection;
use App\Repositories\GithubRepository;
use App\Services\GithubService;
use App\Services\StatisticsCounter;
use Illuminate\Http\Response;

/**
 * Class StatisticsController
 * @package App\Http\Controllers
 */
final class StatisticsController extends Controller
{

    /**
     * @param string $username
     * @param string $repository
     * @return Response
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function repositoryDetails(string $username, string $repository): Response
    {
        $detailedStatisticsCommand = (new DetailedStatisticsQuery())
            ->setUsername($username)
            ->setRepositoryName($repository);

        $repositoryService = new GithubService(new GithubRepository());

        return $this->prepareResponse(
            $repositoryService->getRepositoryDetailedStatistics($detailedStatisticsCommand)
        );
    }

    /**
     * @param string $firstSet
     * @param string $secondSet
     * @return Response
     * @throws \App\Exceptions\InvalidCollectionTypeException
     */
    public function compareRepositories(string $firstSet, string $secondSet)
    {
        $firstRepository = explode(':', $firstSet);
        $secondRepository = explode(':', $secondSet);

        if (count($firstRepository) < 2 || count($secondRepository) < 2) {
            return new Response(ApiConst::PROVIDE_WITH_COLON, 400);
        }

        $firstUsername = $firstRepository[0];
        $firstRepositoryName = $firstRepository[1];
        $secondUsername = $secondRepository[0];
        $secondRepositoryName = $secondRepository[1];

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

        if (!$statisticsQueryCollection->isValid()) {
            return new Response($statisticsQueryCollection->getValidationMessage(), 400);
        }

        $repositoryService = new GithubService(new GithubRepository(), new StatisticsCounter());

        return $this->prepareResponse(
            $repositoryService->getRepositoriesComparedStatistics($statisticsQueryCollection)
        );
    }
}