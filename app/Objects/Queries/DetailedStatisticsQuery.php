<?php declare(strict_types=1);

namespace App\Objects\Queries;

use App\Objects\Common\ApiProblem;
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
     * @return ApiProblem|null
     */
    public function validate(): ?ApiProblem
    {
        if (false !== strpos($this->repositoryName, 'http://') ||
            false !== strpos($this->repositoryName, 'https://') ||
            false !== strpos($this->repositoryName, 'www.')) {
            return (new ApiProblem())
                ->setTitle(ValidationConst::INVALID_ARGUMENT)
                ->setDetail(ValidationConst::PROVIDE_REPOSITORY_NAME)
                ->setStatus(400);
        }

        if (strlen($this->username) <= 1 || strlen($this->repositoryName) <= 1) {
            return (new ApiProblem())
                ->setTitle(ValidationConst::INVALID_ARGUMENT_LENGTH)
                ->setDetail(ValidationConst::INVALID_ARGUMENT_LENGTH_DETAIL)
                ->setStatus(400);
        }

        return null;
    }
}