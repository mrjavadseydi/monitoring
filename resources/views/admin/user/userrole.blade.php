@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">  کاربران</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item ">  کاربران</li>
                        <li class="breadcrumb-item active">  تغییر دسترسی ها</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('تغییر دسترسی') }}</div>
    @if ($message = Session::get('success'))
        <br>
        <div class="alert alert-success alert-block p-2">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="m-2 p-2">
    <form method="post"  action="{{route('userRoleUpdate')}}">
        @csrf
        <p>نام کاربر:
            {{$userdata['name']}}
        </p>
        <p>ایمیل کاربر:
            {{$userdata['email']}}
        </p>
        <p>نوع دسترسی فعلی:
            {{$crole}}
        </p>
        <div class="form-group">
            <input type="hidden" value="{{$userdata['id']}}" name="userid">
            <label for="exampleFormControlSelect1">دسترسی جدید</label>
            <select class="form-control" name="newrole" id="exampleFormControlSelect1">
                <option value="4">کارشناس</option>
                <option value="3">مدیر طبقه</option>
                <option value="2">ناظر</option>
                <option value="1">مدیر اصلی</option>
            </select>
        </div>
        <div >
            <button  style="float: left" class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white" type="submit">ویرایش</button>
        </div>
    </form>
    </div>
    <div class="card-body">
@endsection
