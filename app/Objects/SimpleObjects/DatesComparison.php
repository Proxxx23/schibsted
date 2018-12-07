<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

use App\ApiConst;

/**
 * Class DatesComparison
 * @package App\Objects\SimpleObjects
 */
class DatesComparison
{
    /**
     * @var string $comparisonName
     */
    private $comparisonName = ApiConst::DATES_COMPARISON;

    /**
     * @var string $repositoryName
     */
    private $repositoryName;

    /**
     * @var string $difference
     */
    private $difference;

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return $this->repositoryName;
    }

    /**
     * @param string $repositoryName
     * @return DatesComparison
     */
    public function setRepositoryName(string $repositoryName): DatesComparison
    {
        $this->repositoryName = $repositoryName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDifference(): string
    {
        return $this->difference;
    }

    /**
     * @param string $difference
     * @return DatesComparison
     */
    public function setDifference(string $difference): DatesComparison
    {
        $this->difference = $difference;
        return $this;
    }

    /**
     * @return string
     */
    public function getComparisonName(): string
    {
        return $this->comparisonName;
    }

    /**
     * @param string $comparisonName
     * @return DatesComparison
     */
    public function setComparisonName(string $comparisonName): DatesComparison
    {
        $this->comparisonName = $comparisonName;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'comparisonName' => $this->comparisonName,
            'repositoryName' => $this->repositoryName,
            'difference' => $this->difference,
        ];
    }
}