<?php

namespace Pagekit\Component\Routing;

interface UrlResolverInterface
{
    /**
     * Callback to modify parameters after route matching.
     *
     * @param  array $parameters
     * @return array
     */
    public function match(array $parameters = []);

    /**
     * Callback to modify parameters during URL generation.
     *
     * @param  array $parameters
     * @return array
     */
    public function generate(array $parameters = []);
}
