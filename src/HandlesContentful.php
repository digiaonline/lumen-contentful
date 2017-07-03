<?php

namespace Nord\Lumen\Contentful;

/**
 * Class HandlesContentful
 * @package Nord\Lumen\Contentful
 */
trait HandlesContentful
{

    /**
     * @return ContentfulService
     */
    protected function getContentfulService()
    {
        return app(ContentfulService::class);
    }

}
