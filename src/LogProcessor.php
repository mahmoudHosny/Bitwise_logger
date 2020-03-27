<?php
namespace Bitwise\Logger;


class LogProcessor {

    public function __invoke(array $record)
    {
        $record['extra'] = [
            'user_id' => auth()->user() ? auth()->user()->id : NULL,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'request_url'=>request()->server('REQUEST_URI'),
            'path'=>request()->fullUrl(),
            'method'=>request()->method(),
            'request_data'=>http_build_query(request()->input())
        ];
        return $record;
    }
}
