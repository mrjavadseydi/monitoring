@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ویرایش نوع موانع</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">ویرایش  نوع موانع</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">
        <h5>
            ویرایش نوع موانع
        </h5>
    </div>
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
        <form action="{{route('problemType.update',$data->id)}}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="category">عنوان </label>
                    <input type="text" name="title" class="form-control" value="{{$data->title}}" placeholder="نام هدف : ارتقا ...">
                </div>
            </div>
            <br>
            <div class="col-12">
                <label for="description">توضیحات</label>
                <textarea DIR="RTL" id="some-textarea" class="col-md-12 some-textarea " name="description"
                          placeholder="" style="">{!! $data->description!!}</textarea>
            </div>
            <div>
                <button style="float: left; " class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white"
                        type="submit">ویرایش
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
