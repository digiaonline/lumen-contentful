<?php

namespace Nord\Lumen\Contentful\Tests;

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
            'contentful.api_key'  => 'key',
            'contentful.space_id' => 'secret',
        ]);

        /** @var ContentfulService $service */
        $service = app(ContentfulService::class);
        $client  = $service->getClient();

        // The client object doesn't expose the credentials so we need magic
        $reflectedClient     = new \ReflectionClass($client);
        $reflectedBaseClient = $reflectedClient->getParentClass();

        $baseUriProperty = $reflectedBaseClient->getProperty('baseUri');
        $baseUriProperty->setAccessible(true);
        $tokenProperty = $reflectedBaseClient->getProperty('token');
        $tokenProperty->setAccessible(true);

        $this->assertEquals('https://cdn.contentful.com/spaces/secret/', $baseUriProperty->getValue($client));
        $this->assertEquals('key', $tokenProperty->getValue($client));
    }
}
