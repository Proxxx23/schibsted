<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

use App\ApiConst;

/**
 * Class ForksComparison
 * @package App\Objects\SimpleObjects
 */
class ForksComparison extends BasicComparison
{
    /**
     * @var string $comparisonName
     */
    private $comparisonName = ApiConst::FORKS_COMPARISON;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'comparisonName' => $this->comparisonName,
            'repositoryName' => $this->getRepositoryName(),
            'hasMoreBy' => $this->getHasMoreBy(),
        ];
    }
}