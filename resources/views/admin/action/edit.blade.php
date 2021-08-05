@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ویرایش اقدام </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">ویرایش اقدام </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">{{ __('ویرایش اقدام  ') }}</div>
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
            <form action="{{route('action.update',$data['id'])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>عنوان اقدام </label>
                        <input type="text" name="title" value="{{$data['name']}}" class="form-control"
                               placeholder="عنوان اقدام : مهندسی ...">
                    </div>

                    <div class="form-group col-md-6">
                        <label>زمان تحقق</label>
                        <select class="js-example-basic-single form-control col-md-12  col-sm-12" name="date">
                            <option @if($data['dead_line']==1)
                                    selected
                                    @endif
                                    value="1">سال اول
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
                                    @endif value="4"> سال چهارم
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

                        <input class="observer-example some-textarea " type="hidden"/>
                        <input class="datepicker-demo observer-example-alt" name="delivery" type="hidden">
                    </div>
                </div>
                <div class="row ">

                    <div class="form-group col-md-6" style="">
                        <label>برنامه </label>
                        <select class="js-example-basic-single form-control col-md-12  col-sm-12" name="program">
                            @foreach($category as $c)
                                <option
                                    @if($c['id']==$data['program_id'])
                                    {{'selected'}}
                                    @endif
                                    value="{{$c['id']}}">{{$c['name']}}</option>
                            @endforeach

                        </select>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label>اقدام تکرار شونده</label>
                                <br>
                                <select onchange="chna()" id="select" class="js-example-basic-single form-control"
                                        name="repeat">
                                    <option
                                        @if($data['repeat']==0)
                                        selected
                                        @endif value="0">خیر
                                    </option>
                                    <option @if($data['repeat']==1)
                                            selected
                                            @endif value="1">بله
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>تعداد تکرار </label>
                                <input type="number" name="repeat_count" class="form-control" @if($data['repeat']==1)
                                value="{{$data['repeat_count']}}"
                                       @endif
                                       placeholder="تعداد تکرار"
                                       disabled id="re">
                            </div>
                            @if($data['repeat']==1)
                                <div class="form-group col-md-4">
                                    <label>تعداد دفعات انجام شده </label>
                                    <select class="js-example-basic-single form-control sel2" name="repeat_done">
                                        @for($i=0;$i<=$data['repeat_count'];$i++)
                                            <option @if($data['repeat_done']==$i)
                                                    selected
                                                    @endif
                                                    value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label for="description">توضیحات</label>
                    <textarea id="some-textarea" DIR="RTL" class="col-md-12" name="description"
                              placeholder="توضیحات : دانشکده علوم انسانی" style="">{{$data['description']}}</textarea>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6  col-sm-6">
                        <label>وضعیت اقدام </label>
                        <select class="js-example-basic-single form-control col-md-12  col-sm-12 select1" name="done">
                            <option @if($data['done']==0)
                                    {{'selected'}}
                                    @endif value="0">ثبت نشده
                            </option>
                            <option @if($data['done']==2)
                                    {{'selected'}}
                                    @endif value="2">پایان نرسیده
                            </option>
                            <option @if($data['done']==1)
                                    {{'selected'}}
                                    @endif value="1">به پایان رسیده
                            </option>


                        </select>

                    </div>
                    <div class="col-md-6" style="padding: 15px;">
                        <br>
                        @if($data['done']==1)
                            زمان پایان اقدام :
                            <span id="deli">

                            </span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="col-12 text-ar" @if($data['done']==0)
                style="display: none"
                @endif
                >
                    <label for="description">موانع </label>
                    <textarea id="some-textarea1" DIR="RTL" class="col-md-12 form-control" name="obst"
                              placeholder="این بخش اختیاری میباشد " style="">{{$data['obst']}}</textarea>
                </div>

                <div>
                    <button style="float:left"
                            class="btn btn-success my-4 btn-block col-md-2 col-sm-2 text-center text-white"
                            type="submit">
                        ویرایش
                    </button>
                </div>
                <br>

            </form>
            <br>
            <hr>
            <h5>مستندات:</h5>
            <form action="{{route('uploadInformation')}}" method="post" class="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$data['id']}}">
                <button type="button" class="btn btn-outline-info add">افزودن</button>
                <br>
                <div class="rem1" style="">
                    <div class="row m-1  rem1">
                        <div class="col-md-8  col-sm-8">
                            <div class="input-group">

                                <input type="text" name="des[]" class="form-control" placeholder="توضیحات" required>
                            </div>
                        </div>
                        <div class=" col-md-2 col-sm-2">
                            <span onAddFiles="f1" onCompleteAddFiles="f2" onProgress="f3" onComplete="f4"
                                  class="uploader-click action-up" url="{{ route('uploadfile') }}" accept="image/*"
                                  multliple="false">آپلود مستندات</span>
                            <input type="hidden" name="path[]">
                        </div>
                        <button type="button" class="btn btn-outline-danger remove ">حذف</button>
                    </div>
                </div>
                <span class="next"></span>
                <br>
                <button type="submit" style="float:left;" class="btn btn-success">ذخیره!</button>
            </form>
            <br>
        </div>
        <br>
        <br>
        @if(!empty($files))
            <p>مستندات ارسال شده  :</p>
        @endif
        <div>
            @php($j=1)
            <table class="table table-bordered">
                <thead>
                <TR>
                    <th>ردیف</th>
                    <th>توضیحات</th>
                    <th>مشاهده</th>
                    <th>حذف</th>
                </TR>
                </thead>
                <tbody>
            @foreach($files as $f)

                    <tr>
                        <td>{{$j++}}</td>
                        <td>{{$f['name']}}</td>
                        <td><a href="{{asset($f['path'])}}" target="_blank">کلیک کنید !</a> </td>
                        <td>  <a data-toggle="tooltip" data-placement="top" title="حذف این مورد !" href="#"
                                 style="color: red;" class="trashbtn" data-id="{{$f['id']}}"><i style="font-size: 20px"
                                                                                                class="fa fa-trash"></i></a></td>
                    </tr>

            @endforeach
                </tbody>

            </table>

        </div>
        <div name="csrf-token" content="{{ csrf_token() }}"></div>
        <div class="clone hide">
            <div class="rem1" style="">
                <div class="row m-1 rem col-md-12">
                    <div class="col-md-6  col-sm-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">توضیحات</span>
                            </div>
                            <input type="text" name="des[]" class="form-control" placeholder="توضیحات" required>

                        </div>
                    </div>
                    <div class="file-upload-wrapper col-md-4 col-sm-4">
                        <span onAddFiles="f1" onCompleteAddFiles="f2" onProgress="f3" onComplete="f4"
                              class="uploader-click action-up btn btn-info" url="{{ route('uploadfile') }}"
                              accept="image/*" multiple="false">آپلود مستندات</span>
                        <input type="hidden" name="path[]">
                    </div>
                    <button type="button" class="btn btn-outline-danger remove ">حذف</button>
                </div>
            </div>
        </div>
        @endsection
        @section('script')

                <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
                <script>
                    ClassicEditor.create(document.querySelector('#some-textarea'))
                        .then(function (editor) {
                            // The editor instance
                        })
                        .catch(function (error) {
                            console.error(error)
                        })
                    ClassicEditor.create(document.querySelector('#some-textarea1'))
                        .then(function (editor) {
                            // The editor instance
                        })
                        .catch(function (error) {
                            console.error(error)
                        })
                </script>
            <script>


                $(document).ready(function () {
                    chna();
                    $(document).on('change', '.select1', function () {
                        if ($('.select1').val() != 0) {
                            $('.text-ar').css('display', 'block');
                        } else {
                            $('.text-ar').css('display', 'none');
                        }
                    })
                    $(".add").click(function () {
                        var lsthmtl = $(".rem1").html();
                        $(".next").after(lsthmtl);
                    });
                    $("body").on("click", ".remove", function () {
                        $(this).parents(".rem1").remove();
                    });
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

                document.getElementById('deli').innerText = convertTimeStampToJalali({{$data['delivery']}});

                function convertTimeStampToJalali(timestamp) {
                    var date = new Date(timestamp);
                    if (!date)
                        return false;
                    return (gregorian_to_jalali(date.getFullYear(), (date.getMonth() + 1), date.getDate()));
                }//end of function convertTimeStampToJalali

                function gregorian_to_jalali(gy, gm, gd) {
                    g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
                    if (gy > 1600) {
                        jy = 979;
                        gy -= 1600;
                    } else {
                        jy = 0;
                        gy -= 621;
                    }
                    gy2 = (gm > 2) ? (gy + 1) : gy;
                    days = (365 * gy) + (parseInt((gy2 + 3) / 4)) - (parseInt((gy2 + 99) / 100)) + (parseInt((gy2 + 399) / 400)) - 80 + gd + g_d_m[gm - 1];
                    jy += 33 * (parseInt(days / 12053));
                    days %= 12053;
                    jy += 4 * (parseInt(days / 1461));
                    days %= 1461;
                    if (days > 365) {
                        jy += parseInt((days - 1) / 365);
                        days = (days - 1) % 365;
                    }
                    jm = (days < 186) ? 1 + parseInt(days / 31) : 7 + parseInt((days - 186) / 30);
                    jd = 1 + ((days < 186) ? (days % 31) : ((days - 186) % 30));
                    return jy + '/' + jm + '/' + jd;
                }


                $(document).on('click', '.trashbtn', function (e) {
                    let _token = $('div[name="csrf-token"]').attr('content');
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id);
                    Swal.fire({
                        title: 'آیا  اطمینان دارید ؟',
                        text: "آیا از حذف این رکورد اطمینان دارید ؟ این دیتا قابل بازیابی نخواهد بود !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: "خیر منصرف شدم!",
                        confirmButtonText: 'بله !'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: "POST",
                                url: "{{route('upload.delete')}}",
                                data: {id: id, _token: _token},
                                success: function (data) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'حذف رکورد از دیتابیس با موفقیت انجام شد !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1800);

                                }
                            });
                        }
                    })
                });

                function f1(data) {

                }

                function f2(data) {

                }

                function f3(percent, key) {
                    console.log(percent);
                    $('.action-up.click').text('میزان پیشرفت :' + percent);
                }

                function f4(status, data) {
                    console.log(data);
                    $('.action-up.click').text('ارسال شد!');
                    $('.action-up.click').next().val(data.path);
                }

                $(document).on('click', '.action-up', function () {
                    $('.action-up').removeClass('click');
                    $(this).addClass('click');
                })
                $(document).on('change', '.select1', function () {
                    if ($('.select1').val() != 0) {
                        $('.text-ar').css('display', 'block');
                    } else {
                        $('.text-ar').css('display', 'none');
                    }
                })

                function chna() {
                    var sel = $("#select option:selected").val();
                    if (sel == 1) {
                        $('#re').removeAttr('disabled');
                        $('#re').attr('required', 'true');
                        $('#sel2').attr('required', 'true');
                    } else {
                        $('#re').attr('disabled', 'true');
                    }
                }

                chna();
            </script>
@endsection
