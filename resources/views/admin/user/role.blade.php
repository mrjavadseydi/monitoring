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
    <div class="card-header">{{ __('تغییر دسترسی ها') }}</div>

    <table id="myTable" class="table table-bordered data-table col-md-12 p-2">
        <thead>
        <tr>
            <th>نام </th>
            <th>ایمیل</th>
            <th>بیشتر</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
            <tr>
                <td>{{$d['name']}}</td>
                <td>{{$d['email']}}</td>
                <td>
                    <form action="{{route('roleMaker')}}" method="get">

                        <input type="hidden" name="userid" value="{{$d['id']}}">
                        <button type="submit" class="btn btn-outline-info" >تغییر دسترسی های این کاربر</button>
                    </form>

                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    <div class="card-body">

        <script type="application/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
        <script type="application/javascript">

            $(document).ready( function () {
                $('#myTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Persian.json"
                    }
                });
            } );
        </script>
@endsection
