<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', 'عنوان') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('link', 'لینک') !!}
            {{-- {!! Form::select('link', $menus, null, ['class' => 'form-control', 'required']) !!} --}}
            @php
                $departments = App\Department::all();
                $courses = App\Course::all();
                $pages = App\Page::all();
            @endphp
            <select name="link" id="link" class="form-control" style="display: block;width: 100%;">
                <option selected="selected" value="">انتخاب کنید</option>
                <optgroup label="دپارتمان ها">
                @foreach ($departments as $item)
                <option value="{{ route('site.courses.department', $item->slug) }}">{{ $item->title }}</option>
                @endforeach
                </optgroup>
                <optgroup label="دوره ها">
                @foreach ($courses as $item)
                <option value="{{ route('site.courses.show', $item->slug) }}">{{ $item->title }}</option>
                @endforeach
                </optgroup>
                <optgroup label="برگه ها">
                @foreach ($pages as $item)
                <option value="{{ route('site.page', $item->slug) }}">{{ $item->title }}</option>
                @endforeach
                </optgroup>
                <option value="none">بدون لینک</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('menu_pos_id', 'موقیعت') !!}
            {!! Form::select('menu_pos_id', App\MenuPos::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('parent_id', 'مادر') !!}
            {!! Form::select('parent_id', App\Menu::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'انتخاب کنید']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('image', 'تصویر (منوی مادر)') !!} <br>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{ ($menu->image_url) ? $menu->image_url : 'http://placehold.it/200x150&text=No+Image' }}" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">انتخاب تصویر</span>
                        <span class="fileinput-exists">تغییر</span>
                        {!! Form::file('image') !!}
                    </span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">حذف</a>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $("#link").select2({
        dir: "rtl",
        tags: true
    });
</script>
@endsection