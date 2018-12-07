<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

use App\ApiConst;

/**
 * Class ClosedPullRequestsComparison
 * @package App\Objects\SimpleObjects
 */
class ClosedPullRequestsComparison extends BasicComparison
{
    /**
     * @var string $comparisonName
     */
    private $comparisonName = ApiConst::CLOSED_PULL_REQUESTS_COMPARISON;

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