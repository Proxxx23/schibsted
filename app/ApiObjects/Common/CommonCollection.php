<?php declare(strict_types=1);

namespace App\ApiObjects\Common;


class CommonCollection
{

    /**
     * @var array $elements
     */
    private $elements = [];

    public function addCollectionElement($element) //TODO: Konkretny typ
    {
        $this->elements[] = $element;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->elements);
    }

    /**
     * @return array
     */
    public function getCollectionElements()
    {
        return $this->elements;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this->elements as $element) {
            $array[] = [
                $element => $element->getFirstname(),
            ];
        }
        return $array;
    }

}