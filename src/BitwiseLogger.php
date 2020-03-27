<?php
namespace Bitwise\Logger;

use Monolog\Logger;

class BitwiseLogger{

    public function __invoke(array $config)
    {
        $channel = config('bitwise_logger.channel_name',"Bitwise Logger");

        $logger = new Logger($channel);
        $logger->pushHandler(new LogHandler());
        $logger->pushProcessor(new LogProcessor());
        return $logger;
    }
}
