<?php /** @var \App\Models\BlogPost $post */ ?>
<div class="row justify-content-center">
    <div class="card">
        <div class="card-header">Status</div>

        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#adddata" role="tab">Additional data</a>
                </li>
            </ul>

            <br>

            <div class="tab-content">
                <div class="tab-pane active" id="maindata" role="tabpanel">
                    <div class="form-group row">
                        {{Form::label('title', 'Title', ['class' => 'col-md-3 col-form-label text-md-right'])}}
                        <div class="col-md-6">
                            {{Form::text('title', $post->title, ['class' => 'form-control', 'required',])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('content_raw', 'Post', ['class' => 'col-md-3 col-form-label text-md-right'])}}
                        <div class="col-md-8">
                            {{Form::textarea('content_raw', old('content_raw', $post->content_raw), ['class' => 'form-control', 'rows' => 10])}}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" style="width: 480px" id="adddata" role="tabpanel">
                    <div class="form-group row">
                        {{Form::label('category_id', 'Category', ['class' => 'col-md-3 col-form-label text-md-right'])}}
                        <div class="col-md-8">
                            {{Form::select('category_id', $categoryList, $defaultCategory, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('slug', 'Slug', ['class' => 'col-md-3 col-form-label text-md-right'])}}
                        <div class="col-md-8">
                            {{Form::text('slug', $post->slug, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('excerpt', 'Excerpt', ['class' => 'col-md-3 col-form-label text-md-right'])}}
                        <div class="col-md-8">
                            {{Form::textarea('excerpt', old('excerpt', $post->excerpt), ['class' => 'form-control', 'rows' => 3])}}
                        </div>
                    </div>
                    <div class="form-check">
                        <input name="is_published" type="hidden" value="0">
                        <input name="is_published" type="checkbox" class="form-check-input"
                        value="1" @if($post->is_published) checked="checked" @endif>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
