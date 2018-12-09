<?php declare(strict_types=1);

namespace App\Objects\Common;

/**
 * Proposal documentation: https://tools.ietf.org/html/rfc7807
 * Not all the fields are implemented
 *
 * Class ApiProblem
 * @package App\Objects\Common
 */
class ApiProblem
{
    /**
     * @var string $title
     */
    private $title;

    /**
     * @var int $status
     */
    private $status;

    /**
     * @var string|null $detail
     */
    private $detail;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ApiProblem
     */
    public function setTitle(string $title): ApiProblem
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return ApiProblem
     */
    public function setStatus(int $status): ApiProblem
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDetail(): ?string
    {
        return $this->detail;
    }

    /**
     * @param string|null $detail
     * @return ApiProblem
     */
    public function setDetail(?string $detail): ApiProblem
    {
        $this->detail = $detail;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'detail' => $this->detail,
            'status' => $this->status,
        ];
    }
}