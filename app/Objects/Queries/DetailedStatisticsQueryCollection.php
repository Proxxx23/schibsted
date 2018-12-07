<?php declare(strict_types=1);

namespace App\Objects\Queries;

use App\Exceptions\InvalidCollectionTypeException;
use App\Objects\Common\CommonCollection;

/**
 * Class DetailedStatisticsQueryCollection
 * @package App\Objects\Queries
 */
class DetailedStatisticsQueryCollection extends CommonCollection
{
    /**
     * @var \stdClass $collectionType
     */
    protected static $collectionType = DetailedStatisticsQuery::class;

    /**
     * @var string|null $validationMessage
     */
    private $validationMessage;

    /**
     * @param $element
     * @throws InvalidCollectionTypeException
     */
    public function addCollectionElement($element): CommonCollection
    {
        if (!$element instanceof self::$collectionType) {
            throw new InvalidCollectionTypeException();
        }

        parent::addCollectionElement($element);

        return $this;
    }

    /**
     * @param mixed ...$elements
     * @throws InvalidCollectionTypeException
     */
    public function addCollectionElements(...$elements): CommonCollection
    {
        foreach ($elements as $element) {
            if (!$element instanceof self::$collectionType) {
                throw new InvalidCollectionTypeException();
            }
        }

        parent::addCollectionElements($elements);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValidationMessage(): ?string
    {
        return $this->validationMessage;
    }
}