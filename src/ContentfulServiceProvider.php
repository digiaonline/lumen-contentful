<?php

namespace Nord\Lumen\Contentful;

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
        /** @noinspection PhpUndefinedMethodInspection */
        $this->app->configure(self::CONFIG_KEY);

        $this->registerBindings($this->app, $this->app['config']);
    }


    /**
     * @param Container        $container
     * @param ConfigRepository $config
     */
    protected function registerBindings(Container $container, ConfigRepository $config)
    {
        $container->singleton(ContentfulServiceContract::class, function() use ($config) {
            return new ContentfulService($config->get('contentful.api_key'), $config->get('contentful.space_id'));
        });

        $container->alias(ContentfulServiceContract::class, ContentfulService::class);
    }

}
