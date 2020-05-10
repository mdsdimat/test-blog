<?php /** @var \App\Models\BlogPost $post */ ?>
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
@if($post->exists)
    <div class=" row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    ID:{{$post->id}}
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
                        {{Form::label('created_at', 'Created', ['class' => 'col-md-5 col-form-label text-md-right'])}}
                        <div class="col-md-12">
                            {{Form::text('created_at', $post->created_at, ['class' => 'form-control', 'disabled'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('updated_at', 'Updated', ['class' => 'col-md-5 col-form-label text-md-right'])}}
                        <div class="col-md-12">
                            {{Form::text('updated_at', $post->updated_at, ['class' => 'form-control', 'disabled'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('published_at', 'Published', ['class' => 'col-md-5 col-form-label text-md-right'])}}
                        <div class="col-md-12">
                            {{Form::text('published_at', $post->published_at, ['class' => 'form-control', 'disabled'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
