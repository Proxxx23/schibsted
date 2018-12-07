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
     * @var OpenPullRequestsComparison $openPullRequestsComparison
     */
    private $openPullRequestsComparison;

    /**
     * @var ClosedPullRequestsComparison $closedPullRequestsComparison
     */
    private $closedPullRequestsComparison;

    /**
     * @var DatesComparison $datesComparison
     */
    private $datesComparison;

    /**
     * RepositoryComparisonDTO constructor.
     * @param StarsComparison $starsCountComparison
     * @param ForksComparison $forksCountComparison
     * @param WatchersComparison $watchersCountComparison
     * @param OpenPullRequestsComparison $openPullRequestsComparison
     * @param ClosedPullRequestsComparison $closedPullRequestsComparison
     * @param DatesComparison $datesComparison
     */
    public function __construct(
        StarsComparison $starsCountComparison,
        ForksComparison $forksCountComparison,
        WatchersComparison $watchersCountComparison,
        OpenPullRequestsComparison $openPullRequestsComparison,
        ClosedPullRequestsComparison $closedPullRequestsComparison,
        DatesComparison $datesComparison
    )
    {
        $this->starsCountComparison = $starsCountComparison;
        $this->forksCountComparison = $forksCountComparison;
        $this->watchersCountComparison = $watchersCountComparison;
        $this->openPullRequestsComparison = $openPullRequestsComparison;
        $this->closedPullRequestsComparison = $closedPullRequestsComparison;
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
    public function getOpenPullRequestsComparison(): OpenPullRequestsComparison
    {
        return $this->openPullRequestsComparison;
    }

    /**
     * @return ClosedPullRequestsComparison
     */
    public function getClosedPullRequestsComparison(): ClosedPullRequestsComparison
    {
        return $this->closedPullRequestsComparison;
    }

    /**
     * @return DatesComparison
     */
    public function getDatesComparison(): DatesComparison
    {
        return $this->datesComparison;
    }
}