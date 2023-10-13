<?php

namespace App\Services\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            $data['category_id'] = $this->getIdByName(Category::class, $data['category']);
            $tagIds = $this->getIdByName(Tag::class, $data['tags']);

            unset($data['tags'], $data['category']);

            $post = Post::create($data);

            $post->tags()->attach($tagIds);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }

        return $post;
    }

    public function update($post, $data)
    {
        try {
            DB::beginTransaction();


            $data['category_id'] = $this->getIdByName(Category::class, $data['category']);
            $tagIds = $this->getIdByName(Tag::class, $data['tags']);

            unset($data['tags'], $data['category']);

            $post->update($data);
            $post->tags()->sync($tagIds);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

        return $post->fresh();
    }

    private function getIdByName(string $model, object|array $data): int|array
    {
        if (array_is_list($data)) {
            $dataIds = [];

            foreach ($data as $item) {
                $dataIds[] = $model::firstOrCreate(['name' => $item['name']], $item)->id;
            }
            return $dataIds;
        }

        if (is_array($data)) {
            return $model::firstOrCreate(['name' => $data['name']], $data)->id;
        }

        throw new \InvalidArgumentException;
    }


}
