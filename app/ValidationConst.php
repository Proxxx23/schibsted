<?php declare(strict_types=1);

namespace App;

/**
 * Class ValidationConst
 * @package App
 */
final class ValidationConst
{
    /** @var string */
    public const INVALID_ARGUMENT_LENGTH = 'Invalid argument length.';

    /** @var string */
    public const INVALID_ARGUMENT_LENGTH_DETAIL = 'Argument cannot be shorter than 2 characters.';

    /** @var string */
    public const EMPTY_RESPONSE = 'Empty response.';

    /** @var string */
    public const EMPTY_RESPONSE_DETAIL = 'There were no response data from the external service.';

    /** @var string */
    public const INVALID_ARGUMENT = 'Invalid argument provided.';

    /** @var string */
    public const PROVIDE_WITH_COLON = 'Provide repository sets with given pattern: gitHubUser:repositoryName for every data set.';

    /** @var string */
    public const PROVIDE_REPOSITORY_NAME = 'Provide repository name, not web address.';
}