<?php

namespace Nord\Lumen\Contentful;

use Contentful\Delivery\Client;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

/**
 * Class ContentfulServiceProvider
 * @package Nord\Lumen\Contentful
 */
class ContentfulServiceProvider extends ServiceProvider
{

    const CONFIG_KEY = 'contentful';


    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->app->configure(self::CONFIG_KEY);

        $this->registerBindings($this->app, $this->app['config']);
    }


    /**
     * @param Container        $container
     * @param ConfigRepository $config
     */
    protected function registerBindings(Container $container, ConfigRepository $config)
    {
        $container->singleton(ContentfulServiceContract::class, function () use ($config) {
            $apiKey        = $config->get('contentful.api_key');
            $spaceId       = $config->get('contentful.space_id');
            $environmentId = $config->get('contentful.environment_id');
            $preview       = $config->get('contentful.preview');
            $defaultLocale = $config->get('contentful.default_locale');

            $client = new Client($apiKey, $spaceId, $environmentId, $preview, $defaultLocale);

            return new ContentfulService($client);
        });

        $container->alias(ContentfulServiceContract::class, ContentfulService::class);
    }

}
