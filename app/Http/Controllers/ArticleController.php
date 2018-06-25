<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use Exception;
use Log;
use Session;

class ArticleController extends Controller
{
    /**
     * The article repository instance.
     *
     * @var ArticleRepository
     */
    protected $articleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  ArticleRepository
     * @return void
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->articleRepository = $articleRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->findAllArticle();
        return view('article.index', compact('articles'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->articleRepository->getAllCategoryName();

        return view('article.create', compact('categories'));
    }

    /**
     * @param ArticleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleRequest $request)
    {
        $article       = new Article($request->all());

        try {
            $article->save();
            Session::flash('flash_message', 'Article added successfully.');
            return redirect()->route('article.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Edit view of Article.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = $this->articleRepository->getAllCategoryName();

        return view('article.edit', compact('article', 'categories'));
    }

    /**
     * Update Article.
     *
     * @param ArticleRequest $request
     * @param  Article  $article
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());

        try {
            $article->save();
            Session::flash('flash_message', 'Article updated successfully.');
            return redirect()->route('article.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Get Article to delete.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function delete(Article $article)
    {
        return view('article.delete', compact('article'));
    }

    /**
     * Destroy the given article.
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        try{
            $article->delete();
            Session::flash('flash_message', 'Article deleted successfully.');
            return redirect()->route('article.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }
}
