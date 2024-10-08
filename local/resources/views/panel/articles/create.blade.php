@extends('panel.layouts.main')
@section('title')
    افزودن مقاله
@endsection
@section('main')
    {!! Form::model($article , [
        'method' => 'POST',
        'route' =>  'admin.articles.store',
        'files' =>  TRUE
    ]) !!}
    
    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', 'تیتر') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('article_cat_id', 'دسته بندی') !!}
            {!! Form::select('article_cat_id', App\ArticleCat::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('desc', 'خلاصه') !!}
            {!! Form::textarea('desc', null, ['class' => 'form-control', 'required', 'style' => 'height: 100px;']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('content', 'توضیحات') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @php
                $featured = Collect(['no' => 'خیر', 'yes' => 'بله']);
            @endphp
            {!! Form::label('featured', 'ویژه') !!}
            {!! Form::select('featured', $featured, null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('image', 'تصویر') !!} <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{ ($article->image_url) ? $article->image_url : 'http://placehold.it/200x150&text=No+Image' }}" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">انتخاب تصویر</span>
                        <span class="fileinput-exists">تغییر</span>
                        {!! ($article->image_url) ? Form::file('image') : Form::file('image', ['required']) !!}
                    </span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">حذف</a>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(function(){
      $('#content').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize', 'fontname', 'style']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'link', 'table', 'hr']],
            ['misc', ['fullscreen', 'code', 'under', 'redo', 'codeview']]
        ],
        tabsize: 2,
        height: 300
      });
    });
</script>
@endsection

    <button type="submit" class="btn btn-success">
        افزودن
    </button>

    {!! Form::close() !!}
@endsection