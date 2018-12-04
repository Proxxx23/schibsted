<?php declare(strict_types=1);

namespace App\Services;

use App\ApiObjects\DTO\UserRepositoryDTOCollection;
use App\Repositories\GithubRepository;

/**
 * Class GithubService
 * @package App\Services
 */
final class GithubService
{

    /** @var GithubRepository $repository */
    private $repository;

    /**
     * GithubService constructor.
     * @param GithubRepository $githubRepository
     */
    public function __construct(GithubRepository $githubRepository)
    {
        $this->repository = $githubRepository;
    }

    public function getUserRepositoriesList(string $gitHubUser): UserRepositoryDTOCollection
    {
        return $this->repository->getUserRepositoriesList($gitHubUser);
    }

}