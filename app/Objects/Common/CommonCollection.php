<?php declare(strict_types=1);

namespace App\Objects\Common;

use App\Objects\DTO\ValidatorInterface;

/**
 * Class CommonCollection
 * @package App\Objects\Common
 */
class CommonCollection implements ValidatorInterface
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
     * Dodaje element do kolekcji
     *
     * @param object $element
     */
    public function addCollectionElement($element): void
    {
        $this->elements[] = $element;
    }

    /**
     * Dodaje kilka elementów do kolekcji
     *
     * @param object ...$elements
     */
    public function addCollectionElements(...$elements): void
    {
        $elements = reset($elements);
        $elementsCount = count($elements);

        for ($i = 0; $i < $elementsCount; $i++) {
            $this->elements[] = $elements[$i];
        }
    }

    /**
     * Usuwa element z kolekcji
     *
     * @param $index
     */
    public function remove($index): void
    {
        unset($this->elements[$index]);
    }

    /**
     * Zlicza elementy kolekcji
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * Pobiera elementy kolekcji
     *
     * @return array
     */
    public function getCollectionElements(): array
    {
        return $this->elements;
    }

    /**
     * Zwraca tablicę z elementami kolekcji
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
     * Zwraca elementy kolekcji jako JSON
     *
     * @return string|null
     */
    public function toJson(): ?string
    {
        if (empty($this->toArray())) {
            return null;
        }

        return json_encode($this->toArray(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Walidator
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return !(null === $this->toJson());
    }
}