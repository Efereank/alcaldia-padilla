<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Banner;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->published()
            ->latest('published_at')
            ->limit(6)
            ->get();
        
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return view('public.articles.index', compact('articles', 'banners'));
    }

    public function show($slug)
    {
        $article = Article::with('category', 'user')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();
        
        $article->increment('views');
        
        $relatedArticles = Article::with('category')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->published()
            ->latest('published_at')
            ->limit(5)
            ->get();
        
        return view('public.articles.show', compact('article', 'relatedArticles'));
    }

    public function byCategory(Category $category)
    {
        $articles = Article::with('category')
            ->where('category_id', $category->id)
            ->published()
            ->latest('published_at')
            ->limit(8)
            ->get();
        

        
        return view('public.articles.index', compact('articles'));
    }
}