<?php declare(strict_types=1);

namespace App\Objects\Commands;

/**
 * Class DetailedStatisticsQuery
 * @package App\Objects\Commands
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
}