<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\GithubRepository;
use App\Services\GithubService;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
final class MainController extends Controller
{

    public function listRepositories(string $gitHubUser)
    {
        $service = new GithubService(new GithubRepository());
        $result = $service->getUserRepositoriesList($gitHubUser)->getCollectionElements();
        dd($result);die();
    }

    public function basicStatistics()
    {

    }

    public function compareStatistics()
    {

    }

}