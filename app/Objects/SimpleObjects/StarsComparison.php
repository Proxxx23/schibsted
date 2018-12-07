<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

use App\ApiConst;

/**
 * Class StarsComparison
 * @package App\Objects\SimpleObjects
 */
class StarsComparison extends BasicComparison
{
    /**
     * @var string $comparisonName
     */
    private $comparisonName = ApiConst::STARS_COMPARISON;

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