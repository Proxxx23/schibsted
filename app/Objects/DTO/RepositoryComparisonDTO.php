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
     * @var StarsComparison $starsNumberComparison
     */
    private $starsNumberComparison;

    /**
     * @var ForksComparison $forksNumberComparison
     */
    private $forksNumberComparison;

    /**
     * @var WatchersComparison $watchersNumberComparison
     */
    private $watchersNumberComparison;

    /**
     * @var OpenPullRequestsComparison $openPullRequestsNumberComparison
     */
    private $openPullRequestsNumberComparison;

    /**
     * @var ClosedPullRequestsComparison $closedPullRequestsNumberComparison
     */
    private $closedPullRequestsNumberComparison;

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
        $this->starsNumberComparison = $starsNumberComparison;
        $this->forksNumberComparison = $forksNumberComparison;
        $this->watchersNumberComparison = $watchersCountNumber;
        $this->openPullRequestsNumberComparison = $openPullRequestsNumberComparison;
        $this->closedPullRequestsNumberComparison = $closedPullRequestsNumberComparison;
        $this->datesComparison = $datesComparison;
    }

    /**
     * @return StarsComparison
     */
    public function getStarsNumberComparison(): StarsComparison
    {
        return $this->starsNumberComparison;
    }

    /**
     * @return ForksComparison
     */
    public function getForksNumberComparison(): ForksComparison
    {
        return $this->forksNumberComparison;
    }

    /**
     * @return WatchersComparison
     */
    public function getWatchersNumberComparison(): WatchersComparison
    {
        return $this->watchersNumberComparison;
    }

    /**
     * @return OpenPullRequestsComparison
     */
    public function getOpenPullRequestsNumberComparison(): OpenPullRequestsComparison
    {
        return $this->openPullRequestsNumberComparison;
    }

    /**
     * @return ClosedPullRequestsComparison
     */
    public function getClosedPullRequestsNumberComparison(): ClosedPullRequestsComparison
    {
        return $this->closedPullRequestsNumberComparison;
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
                'starsCountComparison' => $this->starsNumberComparison->toArray(),
                'forksCountComparison' => $this->forksNumberComparison->toArray(),
                'watchersCountComparison' => $this->watchersNumberComparison->toArray(),
                'openPullRequestsCountComparison' => $this->openPullRequestsNumberComparison->toArray(),
                'closedPullRequestsCountComparison' => $this->closedPullRequestsNumberComparison->toArray(),
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