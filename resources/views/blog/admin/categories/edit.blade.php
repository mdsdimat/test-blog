@extends('layouts.app')

@section('content')
    <?php /** @var \App\Models\BlogCategory $category */ ?>

    @if($category->exists)
        {{ Form::open(['route' => ['blog.admin.categories.update', $category->id], 'method' => 'patch']) }}
    @else
        {{ Form::open(['route' => ['blog.admin.categories.store']]) }}
    @endif
    <div class="container">
        @include('blog.admin.messages')
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.categories.includes.edit_main_col')
            </div>
            <div class="col-md-4">
                @include('blog.admin.categories.includes.edit_add_col')
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection
