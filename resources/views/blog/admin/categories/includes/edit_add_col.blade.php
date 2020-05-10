<?php /** @var \App\Models\BlogCategory $category */ ?>
<div class=" row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{Form::submit('Click me', ['class' => 'btn btn-primary'])}}
            </div>
        </div>
    </div>
</div>
<br>
@if($category->exists)
<div class=" row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                ID:{{$category->id}}
            </div>
        </div>
    </div>
</div>
<br>
<div class=" row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    {{Form::label('created_at', 'Created', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                    <div class="col-md-12">
                        {{Form::text('created_at', $category->created_at, ['class' => 'form-control', 'disabled'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('updated_at', 'Updated', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                    <div class="col-md-12">
                        {{Form::text('updated_at', $category->updated_at, ['class' => 'form-control', 'disabled'])}}
                    </div>
                </div>
                <div class="form-group row">
                    {{Form::label('deleted_at', 'Deleted', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                    <div class="col-md-12">
                        {{Form::text('deleted_at', $category->deleted_at, ['class' => 'form-control', 'disabled'])}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
