<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositores\Blog\CategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Str;

class CategoryController extends BaseController
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $paginator = $this->categoryRepository->getAllWithPaginate(15);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CategoryRepository $categoryRepository
     *
     * @return Application|Factory|View
     */
    public function create(CategoryRepository $categoryRepository)
    {
        $category = new BlogCategory();

        $categoryList = $categoryRepository->getForSelect();
        $defaultParentCategory = $categoryList->has($category->parent_id)?$category->parent_id:null;

        return view('blog.admin.categories.create',
            compact('category', 'categoryList','defaultParentCategory')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->all();

        $category = new BlogCategory($data);
        $category->save();

        if ($category->exists) {
            return redirect()
                ->route('blog.admin.categories.edit', $category->id)
                ->with(['success' => 'Success']);
        } else {
            return back()
                ->withErrors(['message' => 'Save error.'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getEdit($id);
        if (empty($category)) {
            abort(404);
        }

        $categoryList = $this->categoryRepository->getForSelect();
        $defaultParentCategory = $categoryList->has($category->parent_id)?$category->parent_id:null;

        return view('blog.admin.categories.edit',
            compact('category', 'categoryList','defaultParentCategory')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $category = $this->categoryRepository->getEdit($id);
        if (empty($category)) {
            return back()
                ->withErrors(['message' => "Category $id not found"])
                ->withInput();
        }

        $data = $request->all();
        $result = $category->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $category->id)
                ->with(['success' => 'Success']);
        } else {
            return back()
                ->withErrors(['message' => 'Save error.'])
                ->withInput();
        }
    }
}
