<?php declare(strict_types=1);

namespace App\Objects\DTO;

use App\Objects\SimpleObjects\ClosedPullRequestsComparison;
use App\Objects\SimpleObjects\DatesComparison;
use App\Objects\SimpleObjects\ForksComparison;
use App\Objects\SimpleObjects\OpenPullRequestsComparison;
use App\Objects\SimpleObjects\StarsComparison;
use App\Objects\SimpleObjects\WatchersComparison;

/**
 * Aggregate DTO
 *
 * Class RepositoryComparisonDTO
 * @package App\Objects\DTO
 */
final class RepositoryComparisonDTO
{
    /**
     * @var StarsComparison $starsCountComparison
     */
    private $starsCountComparison;

    /**
     * @var ForksComparison $forksCountComparison
     */
    private $forksCountComparison;

    /**
     * @var WatchersComparison $watchersCountComparison
     */
    private $watchersCountComparison;

    /**
     * @var OpenPullRequestsComparison $openPullRequestsCountComparison
     */
    private $openPullRequestsCountComparison;

    /**
     * @var ClosedPullRequestsComparison $closedPullRequestsCountComparison
     */
    private $closedPullRequestsCountComparison;

    /**
     * @var DatesComparison $datesComparison
     */
    private $datesComparison;

    /**
     * RepositoryComparisonDTO constructor.
     * @param StarsComparison $starsNumberComparison
     * @param ForksComparison $forksNumberComparison
     * @param WatchersComparison $watchersCountNumber
     * @param OpenPullRequestsComparison $openPullRequestsNumberComparison
     * @param ClosedPullRequestsComparison $closedPullRequestsNumberComparison
     * @param DatesComparison $datesComparison
     */
    public function __construct(
        StarsComparison $starsNumberComparison,
        ForksComparison $forksNumberComparison,
        WatchersComparison $watchersCountNumber,
        OpenPullRequestsComparison $openPullRequestsNumberComparison,
        ClosedPullRequestsComparison $closedPullRequestsNumberComparison,
        DatesComparison $datesComparison
    ) {
        $this->starsCountComparison = $starsNumberComparison;
        $this->forksCountComparison = $forksNumberComparison;
        $this->watchersCountComparison = $watchersCountNumber;
        $this->openPullRequestsCountComparison = $openPullRequestsNumberComparison;
        $this->closedPullRequestsCountComparison = $closedPullRequestsNumberComparison;
        $this->datesComparison = $datesComparison;
    }

    /**
     * @return StarsComparison
     */
    public function getStarsCountComparison(): StarsComparison
    {
        return $this->starsCountComparison;
    }

    /**
     * @return ForksComparison
     */
    public function getForksCountComparison(): ForksComparison
    {
        return $this->forksCountComparison;
    }

    /**
     * @return WatchersComparison
     */
    public function getWatchersCountComparison(): WatchersComparison
    {
        return $this->watchersCountComparison;
    }

    /**
     * @return OpenPullRequestsComparison
     */
    public function getOpenPullRequestsCountComparison(): OpenPullRequestsComparison
    {
        return $this->openPullRequestsCountComparison;
    }

    /**
     * @return ClosedPullRequestsComparison
     */
    public function getClosedPullRequestsCountComparison(): ClosedPullRequestsComparison
    {
        return $this->closedPullRequestsCountComparison;
    }

    /**
     * @return DatesComparison
     */
    public function getDatesComparison(): DatesComparison
    {
        return $this->datesComparison;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'comparison' => [
                'starsCountComparison' => $this->starsCountComparison->toArray(),
                'forksCountComparison' => $this->forksCountComparison->toArray(),
                'watchersCountComparison' => $this->watchersCountComparison->toArray(),
                'openPullRequestsCountComparison' => $this->openPullRequestsCountComparison->toArray(),
                'closedPullRequestsCountComparison' => $this->closedPullRequestsCountComparison->toArray(),
                'datesComparison' => $this->datesComparison->toArray(),
            ]
        ];
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}