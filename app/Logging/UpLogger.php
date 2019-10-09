<?php

namespace App\Logging;

use Monolog\Logger;

class UpLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        //print_r($config);
        $portal = config('up.log_dir', 'portal1');
        //echo $portal;
    }
}
