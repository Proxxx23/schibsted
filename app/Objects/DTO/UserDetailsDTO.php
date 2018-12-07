<?php declare(strict_types=1);

namespace App\Objects\DTO;

/**
 * Class UserDetailsDTO
 * @package App\Objects\DTO
 */
final class UserDetailsDTO implements ResponseInterface
{
    /**
     * @var string $login
     */
    private $login;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string|null $name
     */
    private $name;

    /**
     * @var string|null $company
     */
    private $company;

    /**
     * @var string|null $location
     */
    private $location;

    /**
     * @var int $reposCount
     */
    private $reposCount;

    /**
     * @var int $followers
     */
    private $followers;

    /**
     * @var int $following
     */
    private $following;

    /**
     * @var string
     */
    private $userSince;

    /**
     * @var string $lastUpdate
     */
    private $lastUpdate;

    /**
     * UserDetailsDTO constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->login = $data['login'];
        $this->url = $data['url'];
        $this->name = $data['name'];
        $this->company = $data['company'];
        $this->location = $data['location'];
        $this->reposCount = $data['public_repos'];
        $this->followers = $data['followers'];
        $this->following = $data['following'];
        $this->userSince = $data['created_at'];
        $this->lastUpdate = $data['updated_at'];
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return int
     */
    public function getReposCount(): int
    {
        return $this->reposCount;
    }

    /**
     * @return int
     */
    public function getFollowers(): int
    {
        return $this->followers;
    }

    /**
     * @return int
     */
    public function getFollowing(): int
    {
        return $this->following;
    }

    /**
     * @return string
     */
    public function getUserSince(): string
    {
        return $this->userSince;
    }

    /**
     * @return string
     */
    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'login' => $this->login,
            'url' => $this->url,
            'name' => $this->name,
            'company' => $this->company,
            'location' => $this->location,
            'repositoriesCount' => $this->reposCount,
            'followers' => $this->followers,
            'following' => $this->following,
            'userSince' => $this->userSince,
            'lastUpdate' => $this->lastUpdate,
        ];
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}