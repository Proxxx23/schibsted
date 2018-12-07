<?php declare(strict_types=1);

namespace App\Objects\DTO;

/**
 * Interface ResponseInterface
 * @package App\Objects\DTO
 */
interface ResponseInterface
{

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return string|null
     */
    public function toJson(): ?string;

}