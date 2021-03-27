<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repository\PublisherRepository;

class PublisherController extends Controller
{
    private $publisher;

    public function __construct(PublisherRepository $publisher)
    {
        $this->publisher = $publisher;
    }

    public function publishMessage($topic, Request $request)
    {
        $message = $request->all();

        $subscribers = $this->publisher->getSubscibers($topic);

        $subscribers = collect($subscribers);

        $subscribers->each(function ($subscriber) use ($message) {
            

            $notify_subscriber = $this->notifySubscriber($message, $subscriber);

            dd($notify_subscriber);
        });
    }
}
