<?php declare(strict_types=1);

namespace App\Objects\Common;

/**
 * Class ProblemResponse
 * @package App\Objects\Common
 */
class ProblemResponse
{
    /**
     * @var int $httpCode
     */
    private $httpCode;

    /**
     * @var string|null $message
     */
    private $message;

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @param int $httpCode
     * @return ProblemResponse
     */
    public function setHttpCode(int $httpCode): ProblemResponse
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return ProblemResponse
     */
    public function setMessage(?string $message): ProblemResponse
    {
        $this->message = $message;
        return $this;
    }
}