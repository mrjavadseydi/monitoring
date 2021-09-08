@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))

                            <div class="alert alert-success alert-block">

                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong>{{ $message }}</strong>

                            </div>

                            <img src="http://127.0.0.1:8000/images/{{ Session::get('image') }}">

                        @endif



                        @if (count($errors) > 0)

                            <div class="alert alert-danger">

                                <strong>Whoops!</strong> There were some problems with your input.

                                <ul>

                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif
                        <form action="{{route('up')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            Select image to upload:
                            <input type="file" name="image" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
