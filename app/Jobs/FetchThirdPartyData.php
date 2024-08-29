<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\PantherMedia\ImageApi;
use App\Models\Product;
use App\Http\Pond5\FootageApi;
use App\Http\Pond5\MusicApi;

class FetchThirdPartyData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = new Product();
        $keyword = [];
        $keyword['search'] = null;
        if (!empty($this->details['trending_word'])) {
            $keyword['search']  = $this->details['trending_word']->name;
        }
        if (!empty($this->details['is_category'])) {
            $keyword['search'] = $this->details['category'];
        }
        $category_id  = $this->details['category_id'];
        $pageNumber = $this->details['page_number'];
        $limitPond5 = config('thirdparty.pond5.current_per_page_limit');
        $limitPanther = config('thirdparty.panthermedia.current_per_page_limit');

        for ($i = 2; $i <= config('constants.page_limit_to_fetch_for_third_party'); $i++) {

            if (!empty($pageNumber)) {
                $i = $pageNumber;
            }

            if ($this->details['type'] == 'Image') {
                $pantherMediaImages = new ImageApi();
                $pantharmediaData   = $pantherMediaImages->search($keyword, [], $limitPanther, $i);
                if (!empty($pantharmediaData) && count($pantharmediaData) > 0) {
                    $product->savePantherMediaImage($pantharmediaData, $category_id, $this->details['all_request']);
                    if (!empty($this->details['trending_word'])) {
                        $this->details['trending_word']->total_fetched += $limitPanther;
                    }
                }
            }

            if ($this->details['type'] == 'Footage') {
                $footageMedia          = new FootageApi();
                $pond5FootageMediaData = $footageMedia->search($keyword, [], $limitPond5, $i);
                if (!empty($pond5FootageMediaData) && count($pond5FootageMediaData) > 0) {
                    $product->savePond5Footage($pond5FootageMediaData, $category_id, $this->details['all_request']);
                    if (!empty($this->details['trending_word'])) {
                        $this->details['trending_word']->total_fetched += $limitPond5;
                    }
                }
            }

            if ($this->details['type'] == 'Music') {
                $musicMedia          = new MusicApi();
                $pond5MusicMediaData = $musicMedia->search($keyword, [], $limitPond5, $i);
                if (!empty($pond5MusicMediaData) && count($pond5MusicMediaData) > 0) {
                    $product->savePond5Music($pond5MusicMediaData, $category_id, $this->details['all_request']);
                    if (!empty($this->details['trending_word'])) {
                        $this->details['trending_word']->total_fetched += $limitPond5;
                    }
                }
            }

            if ($this->details['type'] == 'Pond5Image') {
                $imagesMedia        = new \App\Http\Pond5\ImageApi();
                $pond5ImagesData    = $imagesMedia->search($keyword, [], $limitPond5, $i);
                if (!empty($pond5ImagesData) && count($pond5ImagesData) > 0) {
                    $product->savePond5Image($pond5ImagesData, $category_id, $this->details['all_request']);
                    if (!empty($this->details['trending_word'])) {
                        $this->details['trending_word']->total_fetched += $limitPanther;
                    }
                }
            }

            $product->checkAndUpdateSimilarSlug();

            if (!empty($this->details['trending_word'])) {
                $this->details['trending_word']->total_run_remain += 1;
                $this->details['trending_word']->save();
            }

            if (!empty($pageNumber)) {
                break;
            }
        }
    }
}
