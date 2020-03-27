<?php
namespace Bitwise\Logger;

use Monolog\Formatter\NormalizerFormatter;

class LogFormatter extends NormalizerFormatter{

    public function __construct()
    {
        parent::__construct();
    }

    public function format(array $record)
    {
        $exception = null;
        if(array_key_exists('exception',$record['context'])){
            $exception = $record['context']['exception'];
        }
        if($exception instanceof \Exception){
            $record['exception'] = get_class($exception);
            $record['stack_trace'] = $exception->getTraceAsString();
            $record['line_no'] = $exception->getLine();
            $record['file_name'] = $exception->getFile();

        }

        return $record;
    }
}
