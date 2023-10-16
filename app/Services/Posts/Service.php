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
    public function store($data): Post
    {
        try {

            DB::beginTransaction();

            $data['category_id'] = $this->getCategoryId($data['category']);
            $tagIds = $this->getTagIds($data['tags']);

            unset($data['tags'], $data['category']);

            $post = Post::create($data);

            $post->tags()->attach($tagIds);

            DB::commit();

        } catch (\UnexpectedValueException $e) {

            DB::rollBack();
            throw new \UnexpectedValueException($e->getMessage());

        }

        return $post;
    }

    public function update($post, $data): Post
    {
        try {
            DB::beginTransaction();

            $data['category_id'] = $this->getCategoryId($data['category']);
            $tagIds = $this->getTagIds($data['tags']);

            unset($data['tags'], $data['category']);

            $post->update($data);
            $post->tags()->sync($tagIds);

            DB::commit();
        } catch (\UnexpectedValueException $e) {
            DB::rollBack();
            throw new \UnexpectedValueException($e->getMessage());
        }

        return $post->fresh();
    }

    private function getCategoryId(array $data): int
    {
        $category = Category::firstOrCreate(['name' => $data['name']], $data);

        if ($category->wasRecentlyCreated || (isset($data['id']) && $category->id === $data['id'])) {
            return $category->id;
        }

        throw new \UnexpectedValueException('No category was found with these credentials');
    }

    private function getTagIds(array $data): array
    {
        $tagIds = [];

        foreach ($data as $item) {
            $tag = Tag::firstOrCreate(['name' => $item['name']], $item);

            if (!($tag->wasRecentlyCreated || (isset($item['id']) && $tag->id === $item['id']))) {
                throw new \UnexpectedValueException('No tag was found with these credentials');
            }

            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }
}
