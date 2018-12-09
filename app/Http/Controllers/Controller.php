<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Objects\Common\ApiProblem;
use App\Objects\DTO\ResponseInterface;
use App\ValidationConst;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * @var array $jsonResponseHeaders
     */
    public static $jsonResponseHeaders = [
        'Content-Type' => 'application/json; charset=utf-8'
    ];

    /**
     * @var array $apiProblemHeaders
     */
    public static $apiProblemHeaders = [
        'Content-Type' => 'application/problem+json; charset=utf-8'
    ];

    /**
     * @var int $jsonOptions
     */
    public static $jsonOptions = JSON_UNESCAPED_UNICODE |
    JSON_UNESCAPED_SLASHES |
    JSON_PRETTY_PRINT;


    /**
     * Prepares response
     *
     * @param ResponseInterface $result
     * @return JsonResponse
     */
    protected function prepareResponse(ResponseInterface $result): JsonResponse
    {
        if (empty($result->toArray())) {
            $apiProblem = (new ApiProblem())
                ->setTitle(ValidationConst::EMPTY_RESPONSE)
                ->setDetail(ValidationConst::EMPTY_RESPONSE_DETAIL)
                ->setStatus(204);
            return $this->problemResponse($apiProblem);
        }

        return response()
            ->json($result->toArray(), 200, self::$jsonResponseHeaders, self::$jsonOptions);
    }

    /**
     * Returns Api Problem response
     *
     * @param ApiProblem $apiProblem
     * @return JsonResponse
     */
    protected function problemResponse(ApiProblem $apiProblem): JsonResponse
    {
        return response()
            ->json($apiProblem->toArray(),
                $apiProblem->getStatus(),
                self::$apiProblemHeaders,
                self::$jsonOptions
            );
    }
}
