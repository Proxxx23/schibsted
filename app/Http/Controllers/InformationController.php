<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\GithubRepository;
use App\Services\GithubService;
use Illuminate\Http\Response;

/**
 * Class InformationController
 * @package App\Http\Controllers
 */
final class InformationController extends Controller
{

    public function listUserRepositories(string $gitHubUser): Response
    {
        $service = new GithubService(new GithubRepository());
        $result = $service->getUserRepositoriesList($gitHubUser);
        return $this->prepareResponse($result);
    }

    public function basicStatistics()
    {

    }

}