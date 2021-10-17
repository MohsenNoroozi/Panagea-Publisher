<?php

namespace App\Http\Controllers;

use App\Events\MessagePublishedToTopic;
use App\Http\Requests\PublishRequest;
use App\Http\Requests\SubscribeRequest;
use App\Models\Subscriber;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;

class PangaeaController extends Controller
{
    /**
     * @param Topic $topic
     * @param SubscribeRequest $request
     * @return JsonResponse
     */
    public function subscribe(Topic $topic, SubscribeRequest $request): JsonResponse
    {
        Subscriber::updateOrCreate($request->validated())
            ->topics()
            ->syncWithoutDetaching($topic->id);

        return response()->json([
            'url' => $request->safe()->only('url')['url'],
            'topic' => $topic->title,
        ]);
    }

    /**
     * @param Topic $topic
     * @param PublishRequest $request
     * @return JsonResponse
     */
    public function publish(Topic $topic, PublishRequest $request): JsonResponse
    {
        foreach ($topic->subscribers as $subscriber) {
            MessagePublishedToTopic::dispatch($subscriber, [
                'topic' => $topic->title,
                'data' => $request->validated(),
            ] );
        }

        return response()->json([
            'topic' => $topic->title,
            'data' => $request->validated(),
        ]);
    }

}
