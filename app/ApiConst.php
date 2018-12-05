<?php declare(strict_types=1);

namespace App;

/**
 * Class ApiConst
 * @package App
 */
final class ApiConst
{

    public const PROVIDE_WITH_COLON = 'Invalid request data! Please provide repository sets with given
                                        pattern: gitHubUser:repositoryName for every set.';

    public const EMPTY_USERNAME_OR_REPOSITORY_LINK = 'Invalid data given! Neither username nor repository link may be empty';

}