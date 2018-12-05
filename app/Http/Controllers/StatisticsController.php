<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Objects\Commands\RepositoryDetailedStatisticsCommand;
use App\Repositories\GithubRepository;
use App\Services\GithubService;
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
     */
    public function repositoryDetails(string $username, string $repository): Response
    {
        $detailedStatisticsCommand = (new RepositoryDetailedStatisticsCommand())
            ->setUsername($username)
            ->setRepositoryName($repository);

        $repositoryService = new GithubService(new GithubRepository());

        return $this->prepareResponse(
            $repositoryService->getRepositoryDetailedStatistics($detailedStatisticsCommand)
        );
    }


    public function compareRepositories()
    {

    }

}