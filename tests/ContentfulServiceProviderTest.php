<?php

namespace Nord\Lumen\Contentful\Tests;

use Contentful\Delivery\Client;
use Contentful\Delivery\ResourcePool\Extended;
use Laravel\Lumen\Application;
use Nord\Lumen\Contentful\ContentfulService;
use Nord\Lumen\Contentful\ContentfulServiceProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class ContentfulServiceProviderTest
 * @package Nord\Lumen\Contentful\Tests
 */
class ContentfulServiceProviderTest extends TestCase
{

    /**
     * Checks that container bindings are okay
     */
    public function testRegisterBindings()
    {
        $app = new Application();
        $app->register(ContentfulServiceProvider::class);

        config([
            'contentful.api_key'        => 'key',
            'contentful.space_id'       => 'secret',
            'contentful.environment_id' => 'something',
            'contentful.preview'        => true,
        ]);

        /** @var ContentfulService $service */
        $service = app(ContentfulService::class);
        $client  = $service->getClient();

        // Basic test only
        /** @var Client $client */
        $this->assertTrue($client->isPreviewApi());
    }

    public function testPreviewApiNotEnabled()
    {
        $app = new Application();
        $app->register(ContentfulServiceProvider::class);

        config([
            'contentful.api_key'        => 'key',
            'contentful.space_id'       => 'secret',
            'contentful.environment_id' => 'something',
            'contentful.preview'        => false,
        ]);

        /** @var ContentfulService $service */
        $service = app(ContentfulService::class);
        $client  = $service->getClient();

        /** @var Client $client */
        $this->assertFalse($client->isPreviewApi());
    }

    /**
     * @param bool $lowResourceMemoryPool
     *
     * @dataProvider useLowResourceMemoryPoolProvider
     */
    public function testUseLowResourceMemoryPool(bool $lowResourceMemoryPool)
    {
        $app = new Application();
        $app->register(ContentfulServiceProvider::class);

        config([
            'contentful.api_key'                  => 'key',
            'contentful.space_id'                 => 'secret',
            'contentful.environment_id'           => 'something',
            'contentful.low_memory_resource_pool' => $lowResourceMemoryPool,
        ]);

        /** @var ContentfulService $service */
        $service = app(ContentfulService::class);
        $client  = $service->getClient();

        /** @var Client $client */
        $this->assertEquals(!$lowResourceMemoryPool, $client->getResourcePool() instanceof Extended);
    }

    /**
     * @return array
     */
    public function useLowResourceMemoryPoolProvider(): array
    {
        return [
            [true],
            [false],
        ];
    }
}
