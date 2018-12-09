<?php declare(strict_types=1);

namespace Tests\Unit;

use App\Objects\Common\ApiProblem;
use App\Objects\DTO\UserDetailsDTO;
use App\Objects\Queries\DetailedStatisticsQuery;
use App\Objects\Queries\DetailedStatisticsQueryCollection;
use App\ValidationConst;
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

    public function testDetailedStatisticsQueryCanBeInstantiated(): void
    {
        self::assertInstanceOf(DetailedStatisticsQuery::class, new DetailedStatisticsQuery());
    }

    public function testDetailedStatisticsQueryCollectionCanBeInstantiated(): void
    {
        self::assertInstanceOf(DetailedStatisticsQueryCollection::class,
            new DetailedStatisticsQueryCollection());
    }

    public function testUserDetailsDTOCanBeInstantiated(): void
    {
        self::assertInstanceOf(UserDetailsDTO::class, new UserDetailsDTO(self::$dataMock));
    }

    public function testUserDetailsDTOReturnsProperData(): void
    {
        $userDetails = new UserDetailsDTO(self::$dataMock);

        self::assertInternalType('string', $userDetails->getLogin());
        self::assertInternalType('string', $userDetails->getUrl());
        self::assertInternalType('string', $userDetails->getName());
        self::assertInternalType('string', $userDetails->getCompany());
        self::assertInternalType('string', $userDetails->getLocation());
        self::assertInternalType('integer', $userDetails->getReposCount());
        self::assertInternalType('integer', $userDetails->getFollowers());
        self::assertInternalType('integer', $userDetails->getFollowing());
        self::assertInternalType('string', $userDetails->getUserSince());
        self::assertInternalType('string', $userDetails->getLastUpdate());
    }

    public function testUserDetailsDTOReturnsProperArray(): void
    {
        $userDetails = new UserDetailsDTO(self::$dataMock);

        self::assertNotNull($userDetails->toArray());
        self::assertInternalType('array', $userDetails->toArray());
    }

    /**
     * @return array
     */
    public function providerWebAddresses(): array
    {
        return [
            ['www.webaddress.com'],
            ['http://webaddress.com'],
            ['https://webaddress.com'],
        ];
    }

    /**
     * @dataProvider providerWebAddresses
     */
    public function testDetailedStatisticsQueryReturnsApiProblemOnRepositoryWebAddressGiven(
        string $webAddress
    ): void
    {
        $mock = [
            'username' => 'Username',
            'repositoryName' => $webAddress,
        ];

        $instance = (new DetailedStatisticsQuery())
            ->setUsername($mock['username'])
            ->setRepositoryName($mock['repositoryName']);

        self::assertInstanceOf(ApiProblem::class, $instance->validate());
        self::assertEquals(ValidationConst::PROVIDE_REPOSITORY_NAME, $instance->validate()
            ->getDetail()
        );
    }

    public function testDetailedStatisticsQueryReturnsApiProblemOnTooShortUsername(): void
    {
        $instance = (new DetailedStatisticsQuery())
            ->setUsername('a')
            ->setRepositoryName('reponame');

        self::assertInstanceOf(ApiProblem::class, $instance->validate());
        self::assertEquals(ValidationConst::INVALID_ARGUMENT_LENGTH_DETAIL, $instance->validate()
            ->getDetail()
        );
    }


    public function testDetailedStatisticsQueryReturnsApiProblemOnTooShortRepositoryName(): void
    {
        $instance = (new DetailedStatisticsQuery())
            ->setUsername('Test')
            ->setRepositoryName('b');

        self::assertInstanceOf(ApiProblem::class, $instance->validate());
        self::assertEquals(ValidationConst::INVALID_ARGUMENT_LENGTH_DETAIL, $instance->validate()
            ->getDetail()
        );
    }
}
