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
     * @var array $collectionType
     */
    protected static $collectionTypes = [
        RepositoryDetailsDTO::class,
        RepositoryComparisonDTO::class
    ];

    /**
     * @var RepositoryComparisonDTO $comparisonData
     */
    private $comparisonData;

    /**
     * @inheritdoc
     *
     * @param object $element
     *
     * @return CommonCollection
     * @throws InvalidCollectionTypeException
     */
    public function addCollectionElement($element): CommonCollection
    {
        foreach (self::$collectionTypes as $collectionType) {
            if ($element instanceof $collectionType) {
                parent::addCollectionElement($element);
                return $this;
            }
        }

        throw new InvalidCollectionTypeException();
    }

    /**
     * @return RepositoryComparisonDTO
     */
    public function getComparisonData(): RepositoryComparisonDTO
    {
        return $this->comparisonData;
    }

    /**
     * @param RepositoryComparisonDTO $comparisonData
     * @return RepositoryDetailsDTOCollection
     * @throws InvalidCollectionTypeException
     */
    public function setComparisonData(
        RepositoryComparisonDTO $comparisonData
    ): RepositoryDetailsDTOCollection
    {
        $this->addCollectionElement($comparisonData);
        return $this;
    }
}