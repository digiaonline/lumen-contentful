<?php

namespace Nord\Lumen\Contentful;

use Contentful\Delivery\Client\ClientInterface;

/**
 * Interface ContentfulServiceContract
 * @package Nord\Lumen\Contentful
 */
interface ContentfulServiceContract
{

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;
}
