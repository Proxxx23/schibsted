<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

/**
 * Class NumberComparison
 * @package App\Objects\SimpleObjects
 */
final class NumberComparison
{
    /**
     * @var int $repoNumber
     */
    private $repoNumber;

    /**
     * @var int $difference
     */
    private $difference;

    /**
     * @return int
     */
    public function getRepoNumber(): int
    {
        return $this->repoNumber;
    }

    /**
     * @param int $repoNumber
     * @return NumberComparison
     */
    public function setRepoNumber(int $repoNumber): NumberComparison
    {
        $this->repoNumber = $repoNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getDifference(): int
    {
        return $this->difference;
    }

    /**
     * @param int $difference
     * @return NumberComparison
     */
    public function setDifference(int $difference): NumberComparison
    {
        $this->difference = $difference;
        return $this;
    }
}