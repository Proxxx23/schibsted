<?php declare(strict_types=1);

namespace App\Objects\Commands;

use App\ApiConst;
use App\Exceptions\InvalidCollectionTypeException;
use App\Objects\Common\CommonCollection;

/**
 * Class DetailedStatisticsCommandCollection
 * @package App\Objects\Commands
 */
class DetailedStatisticsCommandCollection extends CommonCollection
{
    /**
     * @var \stdClass $collectionType
     */
    protected static $collectionType = DetailedStatisticsCommand::class;

    /**
     * @var string|null $validationMessage
     */
    private $validationMessage;

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

    /**
     * @param $element
     * @throws InvalidCollectionTypeException
     */
    public function addCollectionElements(...$elements): void
    {
        foreach ($elements as $element) {
            if (!$element instanceof self::$collectionType) {
                throw new InvalidCollectionTypeException();
            }
        }

        parent::addCollectionElements($elements);
    }

    /**
     * @return string|null
     */
    public function getValidationMessage(): ?string
    {
        return $this->validationMessage;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        foreach ($this->getCollectionElements() as $element) {
           if (empty($element)) {
               $this->validationMessage = ApiConst::EMPTY_USERNAME_OR_REPOSITORY_LINK;
               return false;
           }
        }

        return true;

    }
}