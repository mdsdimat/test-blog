<?php


namespace App\Repositores\Blog;


use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param integer $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination($perPage = 25)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];
        return $this
            ->startCondition()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category:id,title',
                'user:id,name'])
            ->paginate($perPage);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startCondition()->find($id);
    }
}
