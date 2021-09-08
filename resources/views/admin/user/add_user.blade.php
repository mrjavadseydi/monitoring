@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> افزودن کاربر</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active"> افزودن کاربر</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('افزودن کاربر') }}</div>

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
    <form class="text-center border border-light p-5" method="post" action="{{route('user.store')}}">
        <div class="form-row mb-4">
            @csrf
            <div class="col">
                <!-- First name -->
                <input type="text" name="firstname" id="defaultRegisterFormFirstName" autocomplete="false" class="form-control" placeholder="نام">
            </div>
            <div class="col">
                <!-- Last name -->
                <input type="text" name="lastname"  id="defaultRegisterFormLastName"autocomplete="false" class="form-control" placeholder="نام خانوادگی">
            </div>
        </div>

        <!-- E-mail -->
        <input type="email" name="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="ایمیل">
        <!---cat--->
        <div class="form-group">
            <label for="exampleFormControlSelect1">طبقه این کاربر</label>
            <select class="js-example-basic-multiple form-control" multiple="multiple"  name="category[]" id="exampleFormControlSelect1">
                @foreach($data as $d)
                <option value="{{$d['id']}}">{{$d['name']}}</option>
                @endforeach
            </select>
        </div>
        <!-- Password -->
        <input type="password" name="password" id="defaultRegisterFormPassword" class="form-control" placeholder="رمز عبور" aria-describedby="defaultRegisterFormPasswordHelpBlock">
        <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
           حداقل ۸ کاراکتر
        </small>
    <div >
        <button  style="float: left" class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white" type="submit">افزودن</button>
    </div>

    </form>
    <!-- Default form register -->
    <div class="card-body">
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
        </script>
@endsection
