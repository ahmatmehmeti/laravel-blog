<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ArticleRepository extends BaseRepository
{
    public function getModel()
    {
        return new Article();
    }

    public function getArticles()
    {
        return $this->get();
    }

    public function createArticle(array $data)
    {
        $image = $data['image'];
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images', $name);
        $slug = $this->getSlug($data['title']);

        $article = $this->model->create([
            'title' => $data['title'],
            'body' => $data['body'],
            'slug' => $slug,
            'category_id' => $data['category_id'],
            'user_id' => Auth::user()->id,
            'created_at' => $data['created_at'],
            'image' => $name,
        ]);
        return $article->tags()->sync($data['tags']);
    }

    public function getSlug($title)
    {
        return preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($title) ));
    }

    public function findArticle($id)
    {
        return $this->find($id);
    }

    public function findSelectedTags($article)
    {
        foreach ($article->tags as $tag) {
            $tags_ids[] = $tag->id;
        }
        return $tags_ids;
    }

    public function updateArticle($id ,array $data)
    {
        $article = $this->findArticle($id);
        if(isset($data['image'])){
            $image = $data['image'];
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $name);
        }else{
            $name = $data['image_old'];
        }

        $slug = $this->getSlug($data['title']);

        $article->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'slug' => $slug,
            'category_id' => $data['category_id'],
            'user_id' => Auth::user()->id,
            'created_at' => $data['created_at'],
            'image' => $name,
        ]);
        return $article->tags()->sync($data['tags']);
    }

    public function deleteArticle($id)
    {
        $article = $this->find($id);
        $article->delete();
    }

    public function approveArticle($id)
    {
        $article = $this->findArticle($id);
        return $article->update([
            'status' => '1'
        ]);
    }

    public function getArticlesByCategory($id)
    {
        return  $articles= Article::where('category_id',$id)->get();

    }

}
