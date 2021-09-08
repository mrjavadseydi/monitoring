@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        مشاهده طبقه
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            مشاهده طبقه
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{$data['name']}}</div>

    <div class="card-body">
        @if ($message = Session::get('success'))
            <br>
            <div class="alert alert-success alert-block p-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <p>
            کد طبقه :
            {{$data['code']}}
        </p>
            <p>
                نوع طبقه:
                @if($data['isCollage'])
                    دانشکده
                @else
                    حوزه ستادی
                @endif
            </p>
        <p>
            توضیحات :
            <br>
            @php( print $data['description'])
        </p>
    </div>

@endsection
@section('script')

@endsection
