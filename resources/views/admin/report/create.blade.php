@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        گزارش نهایی
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            گزارش نهایی
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('گزارش نهایی') }}</div>
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
            @if ($message = Session::get('danger'))
                <br>
                <div class="alert alert-danger alert-block p-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        <div class="p-2">
            <form action="{{route('total.report')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>طبقه</label>
                        <br>
                        <select class="js-example-basic-single form-control" name="category">
                            @foreach(\App\Models\Category::all() as $category)
                            <option value="{{$category->code}}"> {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>نیروی انسانی </label>
                        <br>
                        <input type="number" class="form-control" name="h" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>بودجه </label>
                        <br>
                        <input type="number" class="form-control" name="c" required>
                    </div>
                </div>
                <div>
                    <button style="float: left" onclick=""
                            class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white"
                            type="submit">
                        محاسبه و ثبت
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')

@endsection
