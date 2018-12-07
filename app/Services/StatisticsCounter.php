<?php declare(strict_types=1);

namespace App\Services;

use App\ApiConst;
use App\Objects\DTO\RepositoryDetailsDTO;
use App\Objects\DTO\RepositoryDetailsDTOCollection;
use App\Objects\SimpleObjects\BasicComparison;
use App\Objects\SimpleObjects\ClosedPullRequestsComparison;
use App\Objects\SimpleObjects\DatesComparison;
use App\Objects\SimpleObjects\ForksComparison;
use App\Objects\SimpleObjects\NumberComparison;
use App\Objects\SimpleObjects\OpenPullRequestsComparison;
use App\Objects\SimpleObjects\StarsComparison;
use App\Objects\SimpleObjects\WatchersComparison;

/**
 * Class StatisticsCounter
 * @package App\Services
 */
final class StatisticsCounter
{
    /**
     * @param RepositoryDetailsDTO $firstRepo
     * @param RepositoryDetailsDTO $secondRepo
     * @return BasicComparison
     */
    public function compareStarsCount
    (
        RepositoryDetailsDTO $firstRepo,
        RepositoryDetailsDTO $secondRepo
    ): BasicComparison
    {
        $firstRepoNumberOfStars = $firstRepo->getStarsCount();
        $secondRepoNumberOfStars = $secondRepo->getStarsCount();

        /** @var NumberComparison $difference */
        $difference = $this->compareNumbers($firstRepoNumberOfStars, $secondRepoNumberOfStars);

        $repoName = ApiConst::EQUAL_STARS_NUMBER;
        if ($difference->getRepoNumber() === 1) {
            $repoName = $firstRepo->getRepositoryName();
        } elseif ($difference->getRepoNumber() === 2) {
            $repoName = $secondRepo->getRepositoryName();
        }

        return (new StarsComparison())
            ->setRepositoryName($repoName)
            ->setHasMoreBy($difference->getDifference());
    }

    /**
     * @param RepositoryDetailsDTO $firstRepo
     * @param RepositoryDetailsDTO $secondRepo
     * @return BasicComparison
     */
    public function compareForksCount(
        RepositoryDetailsDTO $firstRepo,
        RepositoryDetailsDTO $secondRepo
    ): BasicComparison
    {
        $firstRepoForksCount = $firstRepo->getForksCount();
        $secondRepoForksCount = $secondRepo->getForksCount();

        /** @var NumberComparison $difference */
        $difference = $this->compareNumbers($firstRepoForksCount, $secondRepoForksCount);

        $repoName = ApiConst::EQUAL_FORKS_NUMBER;
        if ($difference->getRepoNumber() === 1) {
            $repoName = $firstRepo->getRepositoryName();
        } elseif ($difference->getRepoNumber() === 2) {
            $repoName = $secondRepo->getRepositoryName();
        }

        return (new ForksComparison())
            ->setRepositoryName($repoName)
            ->setHasMoreBy($difference->getDifference());
    }

    /**
     * @param RepositoryDetailsDTO $firstRepo
     * @param RepositoryDetailsDTO $secondRepo
     * @return BasicComparison
     */
    public function compareWatchersCount(
        RepositoryDetailsDTO $firstRepo,
        RepositoryDetailsDTO $secondRepo
    ): BasicComparison
    {
        $firstRepoWatchersCount = $firstRepo->getWatchersCount();
        $secondRepoWatchersCount = $secondRepo->getWatchersCount();

        /** @var NumberComparison $difference */
        $difference = $this->compareNumbers($firstRepoWatchersCount, $secondRepoWatchersCount);

        $repoName = ApiConst::EQUAL_WATCHERS_NUMBER;
        if ($difference->getRepoNumber() === 1) {
            $repoName = $firstRepo->getRepositoryName();
        } elseif ($difference->getRepoNumber() === 2) {
            $repoName = $secondRepo->getRepositoryName();
        }

        return (new WatchersComparison())
            ->setRepositoryName($repoName)
            ->setHasMoreBy($difference->getDifference());
    }

    /**
     * @param RepositoryDetailsDTO $firstRepo
     * @param RepositoryDetailsDTO $secondRepo
     * @return BasicComparison
     */
    public function compareOpenPullRequests(
        RepositoryDetailsDTO $firstRepo,
        RepositoryDetailsDTO $secondRepo
    ): BasicComparison
    {
        $firstRepoWatchersCount = $firstRepo->getWatchersCount();
        $secondRepoWatchersCount = $secondRepo->getWatchersCount();

        /** @var NumberComparison $difference */
        $difference = $this->compareNumbers($firstRepoWatchersCount, $secondRepoWatchersCount);

        $repoName = ApiConst::EQUAL_OPEN_PULL_REQUESTS_NUMBER;
        if ($difference->getRepoNumber() === 1) {
            $repoName = $firstRepo->getRepositoryName();
        } elseif ($difference->getRepoNumber() === 2) {
            $repoName = $secondRepo->getRepositoryName();
        }

        return (new OpenPullRequestsComparison())
            ->setRepositoryName($repoName)
            ->setHasMoreBy($difference->getDifference());
    }

    /**
     * @param RepositoryDetailsDTOCollection $firstRepo
     * @param RepositoryDetailsDTOCollection $secondRepo
     * @return BasicComparison
     */
    public function compareClosedPullRequests(
        RepositoryDetailsDTO $firstRepo,
        RepositoryDetailsDTO $secondRepo
    ): BasicComparison
    {
        $firstRepoWatchersCount = $firstRepo->getWatchersCount();
        $secondRepoWatchersCount = $secondRepo->getWatchersCount();

        /** @var NumberComparison $difference */
        $difference = $this->compareNumbers($firstRepoWatchersCount, $secondRepoWatchersCount);

        $repoName = ApiConst::EQUAL_CLOSED_PULL_REQUESTS_NUMBER;
        if ($difference->getRepoNumber() === 1) {
            $repoName = $firstRepo->getRepositoryName();
        } elseif ($difference->getRepoNumber() === 2) {
            $repoName = $secondRepo->getRepositoryName();
        }

        return (new ClosedPullRequestsComparison())
            ->setRepositoryName($repoName)
            ->setHasMoreBy($difference->getDifference());
    }

    /**
     * @param RepositoryDetailsDTO $firstRepo
     * @param RepositoryDetailsDTO $secondRepo
     * @return DatesComparison
     * @throws \Exception
     */
    public function compareLatestReleaseDates(
        RepositoryDetailsDTO $firstRepo,
        RepositoryDetailsDTO $secondRepo
    ): DatesComparison
    {
        $firstRepoDate = $firstRepo->getLatestReleaseDate();
        $secondRepoDate = $secondRepo->getLatestReleaseDate();

        $firstDateUnix = strtotime($firstRepoDate);
        $secondDateUnix = strtotime($secondRepoDate);
        $whichIsFresher = $firstDateUnix <=> $secondDateUnix;

        $repoName = ApiConst::LAST_UPDATE_DATES_ARE_THE_SAME;
        if ($whichIsFresher > 0) {
            $repoName = $firstRepo->getRepositoryName();
        } elseif ($whichIsFresher < 0) {
            $repoName = $secondRepo->getRepositoryName();
        }

        $firstRepoDateObj = new \DateTime($firstRepoDate);
        $secondRepoDateObj = new \DateTime($secondRepoDate);

        $difference = $secondRepoDateObj
            ->diff($firstRepoDateObj)
            ->format('%m m %d d %h h %i m %s s');

        return (new DatesComparison())
            ->setRepositoryName($repoName)
            ->setDifference($difference);
    }

    /**
     * Counts differences between two integers and points a repository which bigger number
     *
     * @param int $firstNumber
     * @param int $secondNumber
     * @return NumberComparison
     */
    private function compareNumbers
    (
        int $firstNumber,
        int $secondNumber
    ): NumberComparison
    {
        $whichHasMore = $firstNumber <=> $secondNumber;
        $repoNumber = 0;
        $difference = 0;
        if ($whichHasMore === 1) {
            $repoNumber = 1;
            $difference = ($secondNumber - $firstNumber);
        } elseif ($whichHasMore === -1) {
            $repoNumber = 2;
            $difference = ($firstNumber - $secondNumber);
        }

        return (new NumberComparison())
            ->setRepoNumber($repoNumber)
            ->setDifference($difference);
    }
}