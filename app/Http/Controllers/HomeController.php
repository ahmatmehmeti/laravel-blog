<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $articleRepository;
    protected $categoryRepository;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->middleware(['auth','verified']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->categoryRepository->getCategories();
        $articles = $this->articleRepository->getArticles();
        return view('home',compact('articles','categories'));
    }

    public function category($id)
    {
       $articles =$this-> articleRepository->getArticlesByCategory($id);
        $categories = $this->categoryRepository->getCategories();
        return view('home',compact('articles','categories'));
    }

}
