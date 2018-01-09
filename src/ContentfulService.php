<?php

namespace Nord\Lumen\Contentful;

use Contentful\Delivery\Client;

/**
 * Class ContentfulService
 * @package Nord\Lumen\Contentful
 */
class ContentfulService implements ContentfulServiceContract
{

    /**
     * @var Client
     */
    private $client;


    /**
     * ContentfulService constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @inheritdoc
     */
    public function getClient(): Client
    {
        return $this->client;
    }

}
