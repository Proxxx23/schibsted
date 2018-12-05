<?php declare(strict_types=1);

namespace App\Objects\DTO;

use App\Exceptions\InvalidCollectionTypeException;
use App\Objects\Common\CommonCollection;

/**
 * Class RepositoryDetailsDTOCollection
 * @package App\Objects\DTO
 */
class RepositoryDetailsDTOCollection extends CommonCollection
{
    /**
     * @var \stdClass $collectionType
     */
    protected static $collectionType = RepositoryDetailsDTO::class;

    /**
     * @param $element
     * @throws InvalidCollectionTypeException
     */
    public function addCollectionElement($element): void
    {
        if (!$element instanceof self::$collectionType) {
            throw new InvalidCollectionTypeException();
        }

        parent::addCollectionElement($element);
    }
}