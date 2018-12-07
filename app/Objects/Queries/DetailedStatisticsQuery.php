<?php declare(strict_types=1);

namespace App\Objects\Queries;

use App\Objects\Common\ProblemResponse;
use App\ValidationConst;

/**
 * Class DetailedStatisticsQuery
 * @package App\Objects\Queries
 */
final class DetailedStatisticsQuery
{
    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $repositoryName
     */
    private $repositoryName;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return DetailedStatisticsQuery
     */
    public function setUsername(string $username): DetailedStatisticsQuery
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return $this->repositoryName;
    }

    /**
     * @param string $repositoryName
     * @return DetailedStatisticsQuery
     */
    public function setRepositoryName(string $repositoryName): DetailedStatisticsQuery
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }

    /**
     * Validator
     *
     * @return ProblemResponse|null
     */
    public function validate(): ?ProblemResponse
    {
        if (false !== strpos('http://', $this->repositoryName) ||
            false !== strpos('www.', $this->repositoryName)) {
            return (new ProblemResponse())
                ->setHttpCode(400)
                ->setMessage(ValidationConst::PROVIDE_REPOSITORY_NAME);
        }

        if (strlen($this->username) <= 1 || strlen($this->repositoryName) <= 1) {
            (new ProblemResponse())
                ->setHttpCode(400)
                ->setMessage(ValidationConst::INVALID_LENGTH);
        }

        return null;
    }
}