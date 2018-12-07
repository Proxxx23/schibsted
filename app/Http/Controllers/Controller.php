<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Objects\Common\ProblemResponse;
use App\Objects\DTO\ResponseInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param ResponseInterface $result
     * @return Response
     */
    protected function prepareResponse(ResponseInterface $result): Response
    {
        if (empty($result->toArray())) {
            return new Response(Response::$statusTexts[204], Response::HTTP_NO_CONTENT);
        }

        return new Response($result->toJson(), Response::HTTP_OK);
    }

    /**
     * @param ProblemResponse $problemResponse
     * @return Response
     */
    protected function problemResponse(ProblemResponse $problemResponse): Response
    {
        return new Response($problemResponse->getHttpCode(), $problemResponse->getMessage());
    }
}
