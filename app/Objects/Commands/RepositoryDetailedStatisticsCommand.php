<?php declare(strict_types=1);

namespace App\Objects\Commands;

/**
 * Class RepositoryDetailedStatisticsCommand
 * @package App\Objects\Commands
 */
final class RepositoryDetailedStatisticsCommand
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
     * @return RepositoryDetailedStatisticsCommand
     */
    public function setUsername(string $username): RepositoryDetailedStatisticsCommand
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
     * @return RepositoryDetailedStatisticsCommand
     */
    public function setRepositoryName(string $repositoryName): RepositoryDetailedStatisticsCommand
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }
}