@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        افزودن برنامه
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            افزودن برنامه
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('افزودن برنامه  ') }}</div>
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
            <form action="{{route('program.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>نام برنامه </label>
                        <input type="text" name="title" class="form-control" placeholder="نام برنامه : مهندسی ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label>زمان تحقق </label>
                        <br>
                        <select class="js-example-basic-single form-control" name="date">
                            <option value="1"> سال اول</option>
                            <option value="2">سال دوم</option>
                            <option value="3"> سال سوم</option>
                            <option value="4"> سال چهارم</option>
                            <option value="5"> سال پنجم</option>
                            <option value="6"> طول دوره </option>

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>راهبرد</label>
                        <br>
                        <select class="js-example-basic-single form-control sele" name="strategy" >
                            @if(isset(request()->strategy))
                                <option value="{{$strategy['code'].$strategy['row']}}" stra-id="{{$strategy['id']}}" >{{$strategy['name']}}</option>
                            @else
                                @foreach($strategy as $c)
                                    <option value="{{$c['code'].$c['row']}}"  stra-id="{{$c['id']}}">{{$c['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <input type="hidden" name="stra-id" id="stid">
                    <div class="form-group col-md-6">
                        <label>طبقه</label>
                        <br>
                        <select class="js-example-basic-single form-control" name="category">
                            @if(isset(request()->only))
                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @else
                                @foreach($category as $c)
                                    <option value="{{$c['code']}}">{{$c['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>سقف ایده آل</label>
                        <input type="number" name="ideal" class="form-control" placeholder="3">
                    </div>
                    <div class="form-group col-md-6">
                        <label>میزان به تحقق رسیده</label>
                        <input type="number" name="done" class="form-control" placeholder="1" value="0">
                    </div>

                </div>
                <div class="col-12">
                    <label for="description">توضیحات</label>
                    <textarea id="some-textarea" DIR="RTL" class="col-md-12" name="description"
                              placeholder="توضیحات  " style=""></textarea>
                </div>
                <div>
                    <button style="float: left" onclick="sel1()"
                            class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white"
                            type="submit">
                        افزودن
                    </button>
                </div>
            </form>
        </div>

        @endsection
        @section('script')
<script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
            <script>
       ClassicEditor
      .create(document.querySelector('#some-textarea'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })
                function sel1(){
                    var s = $('.sele').children('option:selected').attr('stra-id');
                    $('#stid').val(s);
                }
                $(document).ready(function () {

                    $('.js-example-basic-single').select2({
                        theme: 'bootstrap4',
                        width: 'resolve'
                    });
                    $('.js-example-basic-multiple').select2();


                });
                $('.observer-example').persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    altField: '.observer-example-alt'
                });
                function chna() {
                   var sel = $( "#select option:selected" ).val();
                   if(sel == 1){
                        $('#re').removeAttr('disabled');
                   }else{
                       $('#re').attr('disabled','true');
                   }
                }
            </script>
@endsection
