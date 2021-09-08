@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        افزودن طبقه
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            افزودن طبقه
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('افزودن طبقه') }}</div>
    <div class="card-body ">
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
        <form action="{{route('category.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="category">نام طبقه</label>
                    <input type="text" name="category" class="form-control" placeholder="نام طبقه : مهندسی ...">
                </div>
                <div class="col-6">
                    <label for="code">کد طبقه</label>
                    <input type="text" class="form-control" name="code" placeholder="کد : LH">
                </div>
            </div>
            <div class="form-group  ">
               <h5> نوع طبقه:</h5>
                <div class="radio p-1">
                    <label><input type="radio" value="true" name="isCollage" checked> پردیس - دانشکده  </label>
                </div>
                <div class="radiop-1">
                    <label><input type="radio" value="false" name="isCollage">حوزه ستادی </label>
                </div>

            </div>
            <div class="col-12">
                <label for="description">توضیحات</label>
                <textarea id="some-textarea" class="col-md-12" DIR="RTL" name="description"
                          placeholder="توضیحات : دانشکده علوم انسانی" style=""></textarea>
            </div>
            <div>
                <button style="float:left;" class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white"
                        type="submit">افزودن
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
@endsection
