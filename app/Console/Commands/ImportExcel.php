<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Imports\PostImport;
use App\Models\Post;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use JsonException;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from excel file';

    /**
     * Execute the console command.
     * @throws GuzzleException
     * @throws JsonException
     */
    public function handle(): void
    {
        $import = Excel::import(new PostImport, public_path('excel/posts.xlsx'));

//        echo 'Created ' . $createdCount . ' of ' . count($data) . ' posts' . PHP_EOL;
        $this->info('Done');
    }
}
