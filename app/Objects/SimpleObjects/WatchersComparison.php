<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

use App\ApiConst;

/**
 * Class WatchersComparison
 * @package App\Objects\SimpleObjects
 */
class WatchersComparison extends BasicComparison
{
    /**
     * @var string $comparisonName
     */
    private $comparisonName = ApiConst::WATCHERS_COMPARISON;

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