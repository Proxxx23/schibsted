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
     * @var RepositoryComparisonDTO;
     */
    private $comparisonData;

    /**
     * @param $element
     * @return CommonCollection
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
     * @return RepositoryComparisonDTO
     */
    public function getComparisonData(): RepositoryComparisonDTO
    {
        return $this->comparisonData;
    }

    /**
     * @param RepositoryComparisonDTO $comparisonData
     * @return RepositoryDetailsDTOCollection
     */
    public function setComparisonData(
        RepositoryComparisonDTO $comparisonData
    ): RepositoryDetailsDTOCollection
    {
        $this->comparisonData = $comparisonData;
        return $this;
    }
}