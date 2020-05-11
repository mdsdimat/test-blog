<?php

namespace App\Repositores\Blog;

use App\Models\BlogCategory as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class CategoryRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param $id
     * @return model
     */
    public function getEdit($id)
    {
        return $this->startCondition()->find($id);
    }

    /**
     * @return Collection
     */
    public function getForSelect()
    {
        $columns = implode(', ',[
            'id',
            'CONCAT (id, ". ", title) AS name',
            ]);
        $list = $this
            ->startCondition()
            ->selectRaw($columns)
            ->get();

        $categoryList = $list->mapWithKeys(function ($item) {
           return [$item->id => $item->name];
        });

        return collect($categoryList);
    }

    /**
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(?int $perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];
        return $this
            ->startCondition()
            ->select($columns)
            ->with(['parentCategory:id,title'])
            ->paginate($perPage);
    }
}
