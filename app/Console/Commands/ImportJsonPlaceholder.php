<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use JsonException;

class ImportJsonPlaceholder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json-placeholder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from json placeholder';

    /**
     * Execute the console command.
     * @throws GuzzleException
     * @throws JsonException
     */
    public function handle(): void
    {
        $client = new ImportDataClient();
        $response = $client->client->request('GET', '/posts');
        $data = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        $createdCount = 0;

        foreach ($data as $item) {
            $post = Post::firstOrCreate([
                'title' => $item->title,
            ], [
                'title' => $item->title,
                'content' => $item->body,
                'user_id' => $item->userId,
                'category_id' => 2
            ]);

            if ($post->wasRecentlyCreated) {
                $createdCount++;
            }
        }

        echo 'Created ' . $createdCount . ' of ' . count($data) . ' posts' . PHP_EOL;
        $this->info('Done');
    }
}
