<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Objects\Common\ProblemResponse;
use App\Repositories\GithubRepository;
use App\Services\GithubService;
use App\Services\StatisticsCounter;
use App\ValidationConst;
use Illuminate\Http\Response;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
final class UserController extends Controller
{
    /**
     * Retrieves details about github user
     *
     * @param string $gitHubUser
     * @return Response
     */
    public function userDetails(string $gitHubUser): Response
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
            $service->getUserDetails($gitHubUser)
        );
    }
}