<?php

namespace App\Http\Controllers;

use App\Article;
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
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' 	 => 'required|string|max:255',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $article = new Article($request->all());
        $article->saveFile($request->file('image_path'));
        dd('hello world');
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
}
