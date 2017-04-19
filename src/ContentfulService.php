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
     * @param string $apiKey
     * @param string $spaceId
     */
    public function __construct($apiKey, $spaceId)
    {
        $this->client = new Client($apiKey, $spaceId);
    }


    /**
     * @inheritdoc
     */
    public function getClient(): Client
    {
        return $this->client;
    }

}
