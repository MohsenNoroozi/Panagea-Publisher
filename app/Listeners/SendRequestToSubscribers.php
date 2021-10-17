<?php

namespace App\Listeners;

use App\Events\MessagePublishedToTopic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendRequestToSubscribers implements ShouldQueue
{
    use InteractsWithQueue;

    public string $connection = 'database';
    public string $queue = 'default';
    public int $tries = 3;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param MessagePublishedToTopic $event
     * @return false
     */
    public function handle(MessagePublishedToTopic $event): bool
    {
        $response = Http::acceptJson()->post($event->subscriber->url, $event->data);

        Log::channel('stderr')->info(
            print_r([
                "status" => $response->status(),
                "body" => $response->body(),
                "SubscriberURL" => $event->subscriber->url,
            ], true)
        );

        return true;
    }

    /**
     * Handle a job failure.
     *
     * @param MessagePublishedToTopic $event
     * @param Throwable $exception
     * @return void
     */
    public function failed(MessagePublishedToTopic $event, Throwable $exception)
    {
        Log::channel('stderr')->info(
            print_r([
                "code" => $exception->getCode(),
                "message" => $exception->getMessage(),
            ], true)
        );
    }
}
