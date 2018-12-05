<?php declare(strict_types=1);

namespace App\Objects\Commands;

/**
 * Class DetailedStatisticsCommand
 * @package App\Objects\Commands
 */
final class DetailedStatisticsCommand
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
     * @return DetailedStatisticsCommand
     */
    public function setUsername(string $username): DetailedStatisticsCommand
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
     * @return DetailedStatisticsCommand
     */
    public function setRepositoryName(string $repositoryName): DetailedStatisticsCommand
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }
}