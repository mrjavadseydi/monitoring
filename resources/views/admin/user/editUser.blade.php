@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> ویرابش کاربر</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active"> ویرابش کاربر</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('ویرابش کاربر') }}</div>

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
    @elseif($message = Session::get('danger'))
        <br>
        <div class="alert alert-danger alert-block p-2">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- Default form register -->
    <form class="text-center border border-light p-5" method="post" action="{{route('user.update',$data['id'])}}">
        <div class="form-row mb-4">
            @csrf
            @method('put')
            <div class="col">
                <!-- First name -->
                <input type="text" name="name" id="defaultRegisterFormFirstName" autocomplete="false" class="form-control" placeholder="نام" value="{{$data['name']}}">
            </div>
        </div>
        <input type="hidden" value="{{$data['id']}}" name="userid">
        <!-- E-mail -->
        <input type="email" name="email" disabled id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="ایمیل" value="{{$data['email']}}">
        <!---cat--->
        <div class="form-group">
            <label for="exampleFormControlSelect1">طبقه این کاربر</label>
            <select class="form-control"  name="category" id="exampleFormControlSelect1">
                @foreach($data1 as $d)
                    <option
                    @if($d['id']==$catid)
                    selected="selected"
                    @endif
                     value="{{$d['id']}}">{{$d['name']}}</option>
                @endforeach
            </select>
        </div>
        <!-- Password -->
        <input type="password" name="password" id="defaultRegisterFormPassword" class="form-control" placeholder="رمز عبور" aria-describedby="defaultRegisterFormPasswordHelpBlock">
        <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
            حداقل ۸ کاراکتر
        </small>
        <div >
            <button  style="float: left" class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white" type="submit">ویرایش</button>
        </div>

    </form>
    <!-- Default form register -->
    <div class="card-body">
@endsection
