<?php declare(strict_types=1);

namespace App\Objects\DTO;

/**
 * Interface ValidatorInterface
 * @package App\Objects\DTO
 */
interface ValidatorInterface
{

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string|null
     */
    public function toJson(): ?string;

}