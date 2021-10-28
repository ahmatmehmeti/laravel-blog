<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepository;
    protected $categoryRepository;
    protected $tagRepository;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->getArticles();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getCategories();
        $tags = $this->tagRepository->getTags();
        return view('articles.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $this->articleRepository->createArticle($request->all());
        return redirect()->route('articles.index');
    }

    public function edit($id)
    {
        $article = $this->articleRepository->findArticle($id);
        $tags_ids = $this->articleRepository->findSelectedTags($article);
        $categories = $this->categoryRepository->getCategories();
        $tags = $this->tagRepository->getTags();
        return view('articles.edit', compact('categories','tags','article','tags_ids'));
    }

    public function update(UpdateArticleRequest $request,$id)
    {
       $this->articleRepository->updateArticle($id,$request->validated());
       return redirect()->route('articles.index');
    }

    public function destroy($id)
    {
        $this->articleRepository->deleteArticle($id);
        return redirect()->route('articles.index');
    }

    public function show($id)
    {
        $article = $this->articleRepository->findArticle($id);
        return view('articles.show', compact('article'));
    }

    public function approve($id)
    {
        $this->articleRepository->approveArticle($id);
        return redirect()->route('articles.index');
    }
}
