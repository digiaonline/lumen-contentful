<?php

namespace Nord\Lumen\Contentful;

use Contentful\Delivery\Client\ClientInterface;

/**
 * Class ContentfulService
 * @package Nord\Lumen\Contentful
 */
class ContentfulService implements ContentfulServiceContract
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * ContentfulService constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }
}
