<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

/**
 * Class BasicComparison
 * @package App\Objects\SimpleObjects
 */
class BasicComparison
{
    /**
     * @var string $repositoryName
     */
    private $repositoryName;

    /**
     * @var int $hasMoreBy
     */
    private $hasMoreBy;

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return $this->repositoryName;
    }

    /**
     * @param string $repositoryName
     * @return BasicComparison
     */
    public function setRepositoryName(string $repositoryName): BasicComparison
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }

    /**
     * @return int
     */
    public function getHasMoreBy(): int
    {
        return $this->hasMoreBy;
    }

    /**
     * @param int $hasMoreBy
     * @return BasicComparison
     */
    public function setHasMoreBy(int $hasMoreBy): BasicComparison
    {
        $this->hasMoreBy = $hasMoreBy;
        return $this;
    }
}