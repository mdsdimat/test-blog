<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogPost;
use App\Repositores\Blog\CategoryRepository;
use App\Repositores\Blog\PostRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PostController extends BaseController
{

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        parent::__construct();

        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $paginator = $this->postRepository->getAllWithPagination(25);

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $post = new BlogPost();

        $categoryList = $this->categoryRepository->getForSelect();
        $defaultCategory = $categoryList->has($post->category_id)?$post->category_id:null;

        return view('blog.admin.posts.create',
            compact('post', 'categoryList','defaultCategory')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogPostCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->all();

        $category = new BlogPost($data);
        $category->save();

        if ($category->exists) {
            return redirect()
                ->route('blog.admin.posts.edit', $category->id)
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
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $post = $this->postRepository->getEdit($id);
        if (empty($post)) {
            abort(404);
        }

        $categoryList = $this->categoryRepository->getForSelect();
        $defaultCategory = $categoryList->has($post->category_id)?$post->category_id:null;

        return view('blog.admin.posts.edit',
            compact('post', 'categoryList','defaultCategory')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogPostUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $post = $this->postRepository->getEdit($id);
        if (empty($post)) {
            return back()
                ->withErrors(['message' => "Post $id not found"])
                ->withInput();
        }

        $data = $request->all();

        $result = $post->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $post->id)
                ->with(['success' => 'Success']);
        } else {
            return back()
                ->withErrors(['message' => 'Save error.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $result= BlogPost::destroy($id);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => 'Success']);
        } else {
            return back()
                ->withErrors(['message' => 'Delete error.']);
        }
    }
}
