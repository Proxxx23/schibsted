<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

use App\ApiConst;

/**
 * Class OpenPullRequestsComparison
 * @package App\Objects\SimpleObjects
 */
class OpenPullRequestsComparison extends BasicComparison
{
    /**
     * @var string $comparisonName
     */
    private $comparisonName = ApiConst::OPEN_PULL_REQUESTS_COMPARISON;

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