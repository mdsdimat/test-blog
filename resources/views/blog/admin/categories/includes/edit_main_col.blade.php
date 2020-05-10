<?php /** @var \App\Models\BlogCategory $category */ ?>
<div class="row justify-content-center">
    <div class="card">
        <div class="card-header">Main data</div>

        <div class="card-body">
            <div class="form-group row">
                {{Form::label('title', 'Title', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                <div class="col-md-6">
                    {{Form::text('title', $category->title, ['class' => 'form-control', 'required', 'maxlength' => 15])}}
                </div>
            </div>

            <div class="form-group row">
                {{Form::label('slug', 'Slug', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                <div class="col-md-6">
                    {{Form::text('slug', $category->slug, ['class' => 'form-control'])}}
                </div>
            </div>

            <div class="form-group row">
                {{Form::label('parent_id', 'Parent', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                <div class="col-md-6">
                    {{Form::select('parent_id', $categoryList, $defaultParentCategory, ['class' => 'form-control'])}}
                </div>
            </div>

            <div class="form-group row">
                {{Form::label('description', 'Description', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                <div class="col-md-6">
                    {{Form::textarea('description', old('description', $category->description), ['class' => 'form-control'])}}
                </div>
            </div>
        </div>
    </div>
</div>
