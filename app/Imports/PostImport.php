<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection): void
    {
        foreach ($collection as $row) {
            if ($row['title']) {
                Post::firstOrCreate([
                    'title' => $row['title'],
                ], [
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'user_id' => $row['user_id'],
                    'category_id' => $row['category_id']
                ]);
            }
        }
    }
}
