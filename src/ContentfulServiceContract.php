<?php

namespace Nord\Lumen\Contentful;

use Contentful\Delivery\Client;

/**
 * Interface ContentfulServiceContract
 * @package Nord\Lumen\Contentful
 */
interface ContentfulServiceContract
{

    /**
     * @return Client
     */
    public function getClient(): Client;

}
