<?php declare(strict_types=1);

namespace App;

/**
 * Class ApiConst
 * @package App
 */
final class ApiConst
{
    /** @var string */
    public const EMPTY_USERNAME_OR_REPOSITORY_LINK = 'Invalid data given! Neither username nor repository link may be empty';

    /** @var string */
    public const EQUAL_STARS_NUMBER = 'Repositories have equal stars number';

    /** @var string */
    public const EQUAL_FORKS_NUMBER = 'Repositories have equal forks number';

    /** @var string */
    public const EQUAL_WATCHERS_NUMBER = 'Repositories have equal watchers number';

    /** @var string */
    public const EQUAL_OPEN_PULL_REQUESTS_NUMBER = 'Repositories have equal open pull requests number';

    /** @var string */
    public const EQUAL_CLOSED_PULL_REQUESTS_NUMBER = 'Repositories have equal closed pull requests number';

    /** @var string */
    public const LAST_UPDATE_DATES_ARE_THE_SAME = 'Last revision dates are the same';

    /** @var string */
    public const STARS_COMPARISON = 'Stars number comparison';

    /** @var string */
    public const FORKS_COMPARISON = 'Forks number comparison';

    /** @var string */
    public const WATCHERS_COMPARISON = 'Watchers number comparison';

    /** @var string */
    public const DATES_COMPARISON = 'Latest release dates comparison';

    /** @var string */
    public const OPEN_PULL_REQUESTS_COMPARISON = 'Open pull requests comparison';

    /** @var string */
    public const CLOSED_PULL_REQUESTS_COMPARISON = 'Closed pull requests comparison';
}