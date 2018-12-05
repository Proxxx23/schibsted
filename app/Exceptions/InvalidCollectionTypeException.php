<?php declare(strict_types=1);

namespace App\Exceptions;

/**
 * Class InvalidCollectionTypeException
 * @package App\Exceptions
 */
class InvalidCollectionTypeException extends \Exception
{

    /**
     * InvalidCollectionTypeException constructor.
     */
    public function __construct()
    {
        parent::__construct('Invalid collection type');
    }
}