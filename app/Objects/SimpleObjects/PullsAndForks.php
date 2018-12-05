<?php declare(strict_types=1);

namespace App\Objects\SimpleObjects;

/**
 * Class PullsAndForks
 * @package App\Objects\SimpleObjects
 */
final class PullsAndForks
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
     * @var int $forks
     */
    private $forks;

    /**
     * @return int
     */
    public function getOpenPullRequests(): int
    {
        return $this->openPullRequests;
    }

    /**
     * @param int $openPullRequests
     * @return PullsAndForks
     */
    public function setOpenPullRequests(int $openPullRequests): PullsAndForks
    {
        $this->openPullRequests = $openPullRequests;
        return $this;
    }

    /**
     * @return int
     */
    public function getClosedPullRequests(): int
    {
        return $this->closedPullRequests;
    }

    /**
     * @param int $closedPullRequests
     * @return PullsAndForks
     */
    public function setClosedPullRequests(int $closedPullRequests): PullsAndForks
    {
        $this->closedPullRequests = $closedPullRequests;
        return $this;
    }

    /**
     * @return int
     */
    public function getForks(): int
    {
        return $this->forks;
    }

    /**
     * @param int $forks
     * @return PullsAndForks
     */
    public function setForks(int $forks): PullsAndForks
    {
        $this->forks = $forks;
        return $this;
    }
}