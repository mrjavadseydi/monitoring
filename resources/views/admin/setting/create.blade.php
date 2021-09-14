@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                       تنظیمات
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                           تنظیمات
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('تنظیمات ') }}</div>
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
            <form action="{{route('settings')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>امکان ویرایش </label>
                        <br>
                        <select class="js-example-basic-single form-control" name="active_for_edit">
                            <option value="1">باز</option>
                            <option value="2" {{$active=="2" ? "selected":""}}>بسته</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <input type="submit" class="btn btn-success" value="ثبت">
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')

@endsection
