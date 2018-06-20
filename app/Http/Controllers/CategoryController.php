<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Category;
use Exception;
use Log;
use Session;

class CategoryController extends Controller
{
    /**
     * The category repository instance.
     *
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  CategoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->findAllCategory();
        return view('category.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'  => 'required|string|unique:categories',
        ]);
        $category = new Category($request->all());
        try {
            $category->save();
            Session::flash('flash_message', 'Category added successfully.');
            return redirect()->route('category.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Edit view of Category.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update Category.
     *
     * @param Request $request
     * @param  Category  $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'  => 'required|string|unique:categories',
        ]);
        $category->fill($request->all());
        try {
            $category->save();
            Session::flash('flash_message', 'Category updated successfully.');
            return redirect()->route('category.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Get category to delete.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Category $category)
    {
        return view('category.delete', compact('category'));
    }

    /**
     * Destroy the given category.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            Session::flash('flash_message', 'Category deleted successfully.');
            return redirect()->route('category.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }
}
