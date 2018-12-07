<?php declare(strict_types=1);

namespace Tests\Unit;

use App\Objects\DTO\UserDetailsDTO;
use App\Objects\Queries\DetailedStatisticsQuery;
use App\Objects\Queries\DetailedStatisticsQueryCollection;
use Tests\TestCase;

/**
 * Class GitHubStatisticsTest
 * @package Tests\Unit
 */
class GitHubStatisticsTest extends TestCase
{
    /**
     * @var array $dataMock
     */
    private static $dataMock = [
        'login' => 'Test',
        'url' => 'http://gitbub.com',
        'name' => 'John Doe',
        'company' => 'Schibsted',
        'location' => 'Gdansk, Poland',
        'public_repos' => 5,
        'followers' => 100,
        'following' => 50,
        'created_at' => '2010-09-01',
        'updated_at' => '2018-12-07',
    ];

    public function testDetailedStatisticsQueryCanBeInstantiated()
    {
        self::assertInstanceOf(DetailedStatisticsQuery::class, new DetailedStatisticsQuery());
    }

    public function testDetailedStatisticsQueryCollectionCanBeInstantiated()
    {
        self::assertInstanceOf(DetailedStatisticsQueryCollection::class,
            new DetailedStatisticsQueryCollection());
    }

    public function testUserDetailsDTOCanBeInstantiated()
    {
        self::assertInstanceOf(UserDetailsDTO::class, new UserDetailsDTO(self::$dataMock));
    }

    public function testUserDetailsDTOReturnsProperData()
    {
        $userDetails = new UserDetailsDTO(self::$dataMock);

        self::assertInternalType('string', $userDetails->getLogin());
        self::assertInternalType('string', $userDetails->getUrl());
        self::assertInternalType('string', $userDetails->getName());
        self::assertInternalType('string', $userDetails->getCompany());
        self::assertInternalType('string', $userDetails->getLocation());
        self::assertInternalType('integer', $userDetails->getReposNumber());
        self::assertInternalType('integer', $userDetails->getFollowers());
        self::assertInternalType('integer', $userDetails->getFollowing());
        self::assertInternalType('string', $userDetails->getUserSince());
        self::assertInternalType('string', $userDetails->getLastUpdate());
    }

    public function testUserDetailsDTOReturnsProperArray()
    {
        $userDetails = new UserDetailsDTO(self::$dataMock);

        self::assertNotNull($userDetails->toArray());
        self::assertInternalType('array', $userDetails->toArray());
    }

    public function testUserDetailsDTOReturnsProperJson()
    {
        $userDetails = new UserDetailsDTO(self::$dataMock);

        self::assertNotEquals('[]', $userDetails->toJson());
        self::assertStringStartsWith('{', $userDetails->toJson());
        self::assertStringEndsWith('}', $userDetails->toJson());
    }
}
