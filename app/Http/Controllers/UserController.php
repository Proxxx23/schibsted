<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Objects\Common\ProblemResponse;
use App\Repositories\GitHubRepository;
use App\Services\GitHubService;
use App\Services\StatisticsCounter;
use App\ValidationConst;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
final class UserController extends Controller
{
    /**
     * Retrieves details about github user
     * @URL /api/user/info/{gitHubUsername} (GET)
     *
     * @param string $gitHubUser
     * @return JsonResponse
     */
    public function userDetails(string $gitHubUser): JsonResponse
    {
        if (strlen($gitHubUser) <= 1) {
            $problemResponse = (new ProblemResponse())
                ->setHttpCode(400)
                ->setMessage(ValidationConst::INVALID_LENGTH);
            return $this->problemResponse($problemResponse);
        }

        $service = new GitHubService(new GitHubRepository(), new StatisticsCounter());
        return $this->prepareResponse(
            $service->getUserDetails($gitHubUser)
        );
    }
}