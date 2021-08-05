@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        ویرایش راهبرد
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            ویرایش راهبرد
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('ویرایش راهبرد ') }}</div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger p-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <br>
            <div class="alert alert-success alert-block p-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="p-2">
            <form action="{{route('strategy.update',$data['id'])}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>نام راهبرد</label>
                        <input type="text" name="title" value="{{$data['name']}}" class="form-control"
                               placeholder="نام راهبرد : مهندسی ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label>کد راهبرد</label>
                        <input type="text" disabled class="form-control" value="{{$data['code']}}" name="code"
                               placeholder="کد : LH">
                        <input type="hidden" value="{{$data['code']}}" name="code">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>طبقه</label>
                        <br>
                        <select class="js-example-basic-single form-control " name="category">

                            @foreach($category as $c)
                                @if($c['id']==$data['category_id'])
                                    {{'selected'}}
                                @endif
                                <option value="{{$c['id']}}">{{$c['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">

                        <span  class="inike-mojtabagoft" style="">هدف</span>

                        <select class="js-example-basic-multiple form-control " name="goal[]" multiple="multiple">
                            @foreach($goal as $g)
                                <option
                                    @if(in_array($g['id'],$ex))
                                    {{'selected'}}
                                    @endif
                                    value="{{$g['id']}}">{{$g['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="description">توضیحات</label>
                    <textarea id="some-textarea" DIR="RTL" class="col-md-12" name="description"
                              placeholder="توضیحات : دانشکده علوم انسانی" style="">{{$data['description']}}</textarea>
                </div>
                <div>
                    <button style="float:left"
                            class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white" type="submit">
                        افزودن
                    </button>
                </div>
            </form>
      </div>
        @endsection
        @section('script')
<script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script>
          ClassicEditor.create(document.querySelector('#some-textarea'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })
      </script>
            <script>
                $(document).ready(function () {
                    $('.js-example-basic-single').select2({
                        theme: 'bootstrap4',
                        width: 'resolve'
                    });

                    $('.js-example-basic-multiple').select2();
                });
            </script>
@endsection
