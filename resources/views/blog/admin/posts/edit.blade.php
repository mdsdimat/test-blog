@extends('layouts.app')

@section('content')
    <?php /** @var \App\Models\BlogPost $post */ ?>

    @if($post->exists)
        {{ Form::open(['route' => ['blog.admin.posts.update', $post->id], 'method' => 'patch']) }}
    @else
        {{ Form::open(['route' => ['blog.admin.posts.store']]) }}
    @endif
    <div class="container">
        @include('blog.admin.messages')
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.posts.includes.edit_main_col')
            </div>
            <div class="col-md-4">
                @include('blog.admin.posts.includes.edit_add_col')
            </div>
        </div>
    </div>
    {{ Form::close() }}

    <br>

    @if($post->exists)
        {{Form::open(['route' => ['blog.admin.posts.destroy', $post->id], 'method' => 'delete'])}}
            <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body ml-auto">
                        <button type="submit" class="btn btn-link">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        {{Form::close()}}
    @endif
@endsection
