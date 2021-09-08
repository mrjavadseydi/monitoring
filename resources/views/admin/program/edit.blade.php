@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        ویرایش برنامه
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            ویرایش برنامه
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('ویرایش برنامه  ') }}</div>
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
            <form action="{{route('program.update',$data['id'])}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>نام برنامه </label>
                        <input type="text" name="title" class="form-control" value="{{$data['name']}}" placeholder="نام برنامه : مهندسی ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label>زمان تحقق</label>
                        <select class="js-example-basic-single form-control" name="date">
                            <option @if($data['dead_line']==1)
                                    selected
                                    @endif value="1">سال اول
                            </option>
                            <option @if($data['dead_line']==2)
                                    selected
                                    @endif value="2">سال دوم
                            </option>
                            <option @if($data['dead_line']==3)
                                    selected
                                    @endif value="3"> سال سوم
                            </option>
                            <option @if($data['dead_line']==4)
                                    selected
                                    @endif value="4">  سال چهارم
                            </option>
                            <option @if($data['dead_line']==5)
                                    selected
                                    @endif value="5">سال پنجم
                            </option>
                            <option @if($data['dead_line']==6)
                                    selected
                                    @endif value="6">طول دوره
                            </option>
                        </select>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>راهبرد</label>
                        <br>
                        <select class="js-example-basic-single form-control sele" name="strategy">
                            @foreach($stra as $c)
                                <option
                                    @if($c['code'].$c['row']==$data['strategy'])
                                    {{'selected'}}
                                    @endif
                                    value="{{$c['code'].$c['row']}}" stra-id="{{$c['id']}}">
                                    {{\App\Models\Category::where('id',$c['category_id'])->first()->code}}

                                    {{$c['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="stra-id" id="stid" >
                <div class="form-group col-md-6">
                        <label>طبقه</label>
                        <br>
                        <select class="js-example-basic-single form-control" name="category">
                            @foreach($cate as $c)
                                <option
                                    @if($c['code']==$data['category'])
                                    {{'selected'}}
                                    @endif
                                    value="{{$c['code']}}">
                                    {{$c['name']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="description">توضیحات</label>
                    <textarea id="some-textarea" class="form-control"  DIR="RTL" class="col-md-12" name="description"
                              placeholder="توضیحات و راهکار ها " style="">{{$data['description']}}</textarea>
                </div>
                <div>
                    <button style="float: left" onclick="sel1()"
                            class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white" type="submit">
                        بروزرسانی
                    </button>
                </div>
            </form>
        </div>

    </div>
        @endsection
        @section('script')
<script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>


            <script>
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
                           ClassicEditor
      .create(document.querySelector('#some-textarea'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })
             ClassicEditor
      .create(document.querySelector('#some-textarea1'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })
             ClassicEditor
      .create(document.querySelector('#some-textarea2'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })


                });




            </script>
@endsection
