<?php declare(strict_types=1);

namespace App\Objects\DTO;

/**
 * Class PullStatisticsDTO
 * @package App\Objects\DTO
 */
final class PullStatisticsDTO
{

    /**
     * @var int $openPullRequests
     */
    private $openPullRequests;

    /**
     * @var int $closedPullRequests
     */
    private $closedPullRequests;

    /**
     * PullStatisticsDTO constructor.
     * @param int $openPullRequests
     * @param int $closedPullRequests
     */
    public function __construct(int $openPullRequests, int $closedPullRequests)
    {
        $this->openPullRequests = $openPullRequests;
        $this->closedPullRequests = $closedPullRequests;
    }

    /**
     * @return int
     */
    public function getOpenPullRequests(): int
    {
        return $this->openPullRequests;
    }

    /**
     * @return int
     */
    public function getClosedPullRequests(): int
    {
        return $this->closedPullRequests;
    }
}