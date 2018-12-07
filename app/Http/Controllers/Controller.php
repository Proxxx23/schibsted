<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Objects\Common\ProblemResponse;
use App\Objects\DTO\ResponseInterface;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{

    /**
     * Prepares response to show to user
     *
     * @param ResponseInterface $result
     * @return Response
     */
    protected function prepareResponse(ResponseInterface $result): Response
    {
        if (empty($result->toArray())) {
            $problemResponse = (new ProblemResponse())
                ->setHttpCode(Response::HTTP_NO_CONTENT)
                ->setMessage(Response::$statusTexts[204]);
            return $this->problemResponse($problemResponse);
        }

        return new Response($result->toJson(), Response::HTTP_OK);
    }

    /**
     * Returns response with error code
     *
     * @param ProblemResponse $problemResponse
     * @return Response
     */
    protected function problemResponse(ProblemResponse $problemResponse): Response
    {
        return new Response($problemResponse->getHttpCode(), $problemResponse->getMessage());
    }
}
