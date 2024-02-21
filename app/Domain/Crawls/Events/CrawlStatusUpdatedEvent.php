<?php

namespace DDD\Domain\Crawls\Events;

use DDD\Domain\Crawls\Crawl;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
// Domains
use Illuminate\Queue\SerializesModels;

class CrawlStatusUpdatedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Crawl $crawl)
    {
        //
    }

    /**
     * Overwrite the event name.
     *
     * @return string Event name
     */
    public function broadcastAs()
    {
        return 'CrawlStatusUpdated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('DDD.Domain.Crawls.Crawl.'.$this->crawl->id);
    }
}
