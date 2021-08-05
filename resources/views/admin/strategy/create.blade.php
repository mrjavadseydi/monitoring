@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        افزودن راهبرد
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            افزودن راهبرد
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('افزودن راهبرد ') }}</div>
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
            <form action="{{route('strategy.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>نام راهبرد</label>
                        <input type="text" name="title" class="form-control" placeholder="نام راهبرد : مهندسی ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label>کد راهبرد</label>
                        <input type="text" class="form-control" name="code" placeholder="کد : LH">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>طبقه</label>
                        <br>
                        <select class="js-example-basic-single form-control" name="category">

                            @if(isset(request()->only))
                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @else
                                @foreach($category as $c)
                                    <option value="{{$c['id']}}">{{$c['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <span  class="inike-mojtabagoft" style="">هدف</span>
                        <select class="js-example-basic-multiple form-control" name="goal[]" multiple="multiple">
                            @foreach($goal as $g)
                                <option value="{{$g['id']}}">{{$g['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="description">توضیحات</label>
                    <textarea id="some-textarea" DIR="RTL" class="col-md-12" name="description"
                              placeholder="توضیحات : دانشکده علوم انسانی" style=""></textarea>
                </div>
                <div>
                    <button style="float: left"
                            class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white"
                            type="submit">
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
