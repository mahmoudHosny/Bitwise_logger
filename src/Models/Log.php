<?php

namespace Bitwise\Logger\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'bitwise_logger_logs';
    protected $guarded = [];
    protected $exception = null;
    protected $ignoreExceptions = [];

    public function logException($exception)
    {
        if(!in_array(get_class($exception),$this->ignoreExceptions)){
            $this->exception = $exception;
            $this->log();
        }
        return $this;
    }


    public function setIgnoreExceptions($exceptions=[]){
        $this->ignoreExceptions = $exceptions;
    }

    protected function log()
    {
        // $channel = config('logging.channels');
        // dd($channel);
        \Illuminate\Support\Facades\Log::channel('bitwise_logger')
            ->error(
                $this->exception->getMessage(),
                array_merge(
                    [],
                    ['exception' => $this->exception]
                )
            );
    }
}
