<?php

namespace DDD\Domain\Crawls\Jobs;

use DDD\App\Services\Crawler\CrawlerInterface as Crawler;
use DDD\Domain\Crawls\Crawl;
use DDD\Domain\Crawls\Events\CrawlStatusUpdatedEvent;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Domains
use Illuminate\Foundation\Bus\Dispatchable;
// Events
use Illuminate\Queue\InteractsWithQueue;
// Services
use Illuminate\Queue\SerializesModels;

class CheckCrawlStatusJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $crawl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Crawl $crawl)
    {
        $this->crawl = $crawl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Crawler $crawler): void
    {
        $crawl = $crawler->getStatus(
            $this->crawl->crawl_id,
            $this->crawl->queue_id
        );

        $this->crawl->update($crawl);

        CrawlStatusUpdatedEvent::dispatch($this->crawl);

        $monitoredStatuses = [
            'READY',
            'RUNNING',
            'TIMING-OUT',
            'ABORTING',
        ];

        if (in_array($crawl['status'], $monitoredStatuses)) {
            dispatch(new self($this->crawl))->delay(5);
        }
    }
}
