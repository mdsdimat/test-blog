@extends('layouts.app')

@section('content')
    <div class="container">
        @include('blog.admin.messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-light">
                    <a class="btn btn-primary" href="{{route('blog.admin.posts.create')}}">Add</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Published at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $post)
                                <?php /** @var \App\Models\BlogPost $post */?>
                                <tr @if (!$post->is_published) style="background-color: #ccc" @endif>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->category->title}}</td>
                                    <td>
                                        <a href="{{route('blog.admin.posts.edit', $post->id)}}">
                                            {{$post->title}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$post->published_at?\Carbon\Carbon::parse($post->published_at)->format('d.M H:i'):''}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </div>
        <?php /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */ ?>
        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{$paginator->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
