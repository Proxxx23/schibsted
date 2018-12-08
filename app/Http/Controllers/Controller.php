<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Objects\Common\ProblemResponse;
use App\Objects\DTO\ResponseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * @var array $headers
     */
    public static $headers = ['Content-Type' => 'application/json; charset=utf-8'];

    /**
     * @var int $jsonOptions
     */
    public static $jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;


    /**
     * Prepares response to show to user
     *
     * @param ResponseInterface $result
     * @return JsonResponse
     */
    protected function prepareResponse(ResponseInterface $result): JsonResponse
    {
        if (empty($result->toArray())) {
            $problemResponse = (new ProblemResponse())
                ->setHttpCode(204)
                ->setMessage('No content');
            return $this->problemResponse($problemResponse);
        }

        return response()
            ->json($result->toArray(), 200, self::$headers, self::$jsonOptions);
    }

    /**
     * Returns response with error code
     *
     * @param ProblemResponse $problemResponse
     * @return JsonResponse
     */
    protected function problemResponse(ProblemResponse $problemResponse): JsonResponse
    {
        return response()
            ->json($problemResponse->toArray(),
                $problemResponse->getHttpCode(),
                self::$headers,
                self::$jsonOptions
            );
    }
}
