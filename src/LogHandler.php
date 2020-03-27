<?php
namespace Bitwise\Logger;

use Monolog\Formatter\FormatterInterface;
use Monolog\Logger;

use Monolog\Handler\AbstractProcessingHandler;
use Bitwise\Logger\Models\Log;

class LogHandler extends AbstractProcessingHandler{

    public function __construct($level = Logger::DEBUG)
    {
        parent::__construct($level);
    }

    protected function write(array $record): void
    {
        $log = new Log();
        $log->level_name = $record['level_name'];
        $log->channel = $record['channel'];
        $log->log_time = $record['datetime'];
        $log->user_id = $record['extra']['user_id'];
        $log->origin = $record['extra']['origin'];
        $log->ip_address = $record['extra']['ip'];
        $log->user_agent = $record['extra']['user_agent'];
        $log->request_url = $record['extra']['request_url'];
        $log->path = $record['extra']['path'];
        $log->request_data = $record['extra']['request_data'];
        $log->method = $record['extra']['method'];
        $log->stack_trace = $record['formatted']['stack_trace'];
        $log->message = $record['message'];
        $log->line_no = $record['formatted']['line_no'];
        $log->file_name = $record['formatted']['file_name'];
        $log->exception = $record['formatted']['exception'];
        $log->save();

    }

    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LogFormatter();
    }
}
