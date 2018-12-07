<?php declare(strict_types=1);

namespace App\Objects\Common;

use App\Objects\DTO\ResponseInterface;

/**
 * Class CommonCollection
 * @package App\Objects\Common
 */
class CommonCollection implements ResponseInterface
{
    /**
     * @var $collectionType
     */
    protected static $collectionType;

    /**
     * @var array $elements
     */
    private $elements = [];

    /**
     * Adds element to collection
     *
     * @param $element
     * @return CommonCollection
     */
    public function addCollectionElement($element): CommonCollection
    {
        $this->elements[] = $element;
        return $this;
    }

    /**
     * Adds more than one element to collection
     *
     * @param mixed ...$elements
     * @return CommonCollection
     */
    public function addCollectionElements(...$elements): CommonCollection
    {
        $elements = reset($elements);
        $elementsCount = count($elements);

        for ($i = 0; $i < $elementsCount; $i++) {
            $this->elements[] = $elements[$i];
        }

        return $this;
    }

    /**
     * Delete element from collection
     *
     * @param $index
     */
    public function remove($index): void
    {
        unset($this->elements[$index]);
    }

    /**
     * Counts collection elements
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * Checks if collection is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * Returns collection elements as objects
     *
     * @return array
     */
    public function getCollectionElements(): array
    {
        return $this->elements;
    }

    /**
     * Returns collection elements as an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this->elements as $element) {
            $array[] = $element->toArray();
        }

        return $array;
    }

    /**
     * Returns collection elements as JSON
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Simple validation
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return !(null === $this->toJson());
    }
}