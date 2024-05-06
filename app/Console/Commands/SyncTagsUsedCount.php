<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncTagsUsedCount extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tags:sync-used-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync tags used count.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Syncing tags used count...');

        // select count group by tag_id
        DB::table('post_tag')
            ->select('tag_id', DB::raw('count(*) as used_count'))
            ->groupBy('tag_id')
            ->get()->each(function ($item) {
                Tag::query()->where('id', $item->tag_id)->update(['used_count' => $item->used_count]);
            });

        $this->info('Tags used count synced.');
    }
}
