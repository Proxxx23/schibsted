<?php declare(strict_types=1);

namespace App\Repositories;

use App\ApiObjects\DTO\UserRepositoryDTO;
use App\ApiObjects\DTO\UserRepositoryDTOCollection;

/**
 * Class GithubRepository
 * @package App
 */
final class GithubRepository
{

    /** @var \Github\Client $github */
    private $github;

    public function __construct()
    {
        $this->github = new \Github\Client();
    }

    public function getUserRepositoriesList(string $gitHubUser): UserRepositoryDTOCollection
    {
        $repositories = $this->github->api('user')->repositories($gitHubUser);

        $userRepositoryDTOCollection = new UserRepositoryDTOCollection();
        foreach ($repositories as $repository) {
            $userRepositoryDTO = new UserRepositoryDTO($repository);
            $userRepositoryDTOCollection->addCollectionElement($userRepositoryDTO);
        }

        return $userRepositoryDTOCollection;
    }
}