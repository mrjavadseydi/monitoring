@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        لیست برنامه ها
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">
                            لیست برنامه ها
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('top_main')
    @if(!empty($stra))
        <div class="card-header">
            مشخصات راهبرد :
            {{$stra['code'].$stra['row']}}
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <br>
                <div class="alert alert-success alert-block p-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <p>نام راهبرد : {{$stra['name']}}</p>

            <P>کد راهبرد : {{$stra['code'].$stra['row']}}</P>

            <P>توضیحات :
                {!! $stra['description'] !!}
            </P>
        </div>
        <br>
    @endif
@endsection
@section('main')

    <div class="card-header">
        <span class="card-title" style="padding-left: 2%">لیست برنامه ها</span>
        @if(\Illuminate\Support\Facades\Cache::get('edit')=="1")
            @if(isset(request()->only))
                <a href="{{route('program.create')}}?only={{$_GET['only']}}"
                   class="btn btn-sm btn-outline-info d-inline-block"
                   style="height: 26px;width: 30px;"><i class="fa fa-plus"></i></a>
            @elseif(isset(request()->strategy))
                <a href="{{route('program.create')}}?strategy={{$_GET['strategy']}}"
                   class="btn btn-sm btn-outline-info d-inline-block"
                   style="height: 26px;width: 30px;"><i class="fa fa-plus"></i></a>
            @else
                <a href="{{route('program.create')}}" class="btn btn-sm btn-outline-info d-inline-block"
                   style="height: 26px;width: 30px;"><i class="fa fa-plus"></i></a>

            @endif
        @endif
        <div class="card-tools">


        </div>

    </div>

    @if ($errors->any())
        <div class="alert alert-danger m-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block m-2">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card-body table-responsive p-0">
        <table id="myTable" class="table  table-hover table-striped">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th style="width: 65px">کد برنامه</th>
                <th>زمان تحقق</th>
                <th>وضعیت برنامه</th>
                <th> اقدامات</th>
                <th>اقدامات انجام شده</th>
                <th>درصد تحقق</th>
                <th>بیشتر</th>
            </tr>
            </thead>
            <tbody>
            {{--            @php($rr = 0)--}}
            @if(!isset($_GET['page']))
                @php($i=1 )
            @else
                @php($i=(1*$_GET['page']*10)-9)
            @endif
            @foreach($data as $rr=> $d)
                <tr>
                    <td>{{$i++}}</td>
                    <td style="width: 25%">{{$d['name']}}</td>
                    <td>{{$d['category'].'-'.$d['strategy'].'-'.$d['row']}}</td>
                    <td class="" onclick="">
                        @if($d['dead_line']==6)
                            طول دوره
                        @else
                            سال {{$plan[$d['dead_line']]}}

                        @endif
                    </td>
                    <td>
                        @if($d['dead_line']==6&&$all[$rr]!=$done[$rr])
                            <a href="#" data-toggle="tooltip" data-placement="top" title="در طول دوره">
                                <i class="fa fa-eercast" aria-hidden="true" style="color: gray"></i>
                            </a>
                        @elseif($d['dead_line']==6&&$all[$rr]==$done[$rr])
                            <a href="#" data-toggle="tooltip" data-placement="top" title="به پایان رسیده ">
                                <i class="fa fa-eercast" aria-hidden="true" style="color: green"></i>
                                @elseif($plan[0]>$plan[$d['dead_line']]&&$all[$rr]==$done[$rr])
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="به پایان رسیده ">
                                        <i class="fa fa-eercast" aria-hidden="true" style="color: green"></i>
                                    </a>
                                @elseif($plan[0]>$plan[$d['dead_line']]&&$all[$rr]!=$done[$rr])
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title=" از زمان تحقق گذشته است ">
                                        <i class="fa fa-eercast" aria-hidden="true" style="color: red"></i>
                                    </a>
                                @elseif($plan[0]<$plan[$d['dead_line']])
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="به زمان تحقق نرسیده است ">
                                        <i class="fa fa-eercast" aria-hidden="true" style="color: gray"></i>
                                    </a>
                        @endif
                    </td>
                    <td>{{$all[$rr]}}</td>
                    <td style="">{{$done[$rr]}}</td>
                    <td>
                        @if($done[$rr]==0)
                            0%
                        @else
                            {{
        ceil((($done[$rr]+1)*100)/(1+$all[$rr]))."٪"
    }}
                        @endif
                    </td>
                    <td>
                        @if(\Illuminate\Support\Facades\Cache::get('edit')=="1")

                            <a class="edit" data-toggle="tooltip" data-placement="top" title="ویرایش"
                               href="{{route('program.edit',$d['id'])}}"><i style="font-size: 20px;"
                                                                            class="fa fa-edit"></i></a>
                        @endif
                        <a data-toggle="tooltip" data-placement="top" title="نمایش اقدامات این برنامه "
                           href="{{route('action.index')}}?only={{$d['id']}}"><i style="font-size: 20px;"
                                                                                 class="fa fa-check-square-o"></i></a>
                        @if(\Illuminate\Support\Facades\Cache::get('edit')=="1")

                            @if(session('level')<2)
                                <a data-toggle="tooltip" data-placement="top" title="حذف این مورد !" href="#"
                                   style="color: red;" class="trashbtn" data-id="{{$d['id']}}"><i
                                        style="font-size: 20px" class="fa fa-trash"></i></a>
                            @endif
                        @endif
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <div name="csrf-token" content="{{ csrf_token() }}"></div>
@endsection
@section('script')
    <script>

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


        String.prototype.toEnglishDigit = function () {
            var find = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            var replace = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            var replaceString = this;
            var regex;
            for (var i = 0; i < find.length; i++) {
                regex = new RegExp(find[i], "g");
                replaceString = replaceString.replace(regex, replace[i]);
            }
            return replaceString;
        };


        function dateP() {
            var td = document.getElementsByClassName('dateP');
            for (i = 0; i < td.length; i++) {
                dat = td[i].innerText;
                dat1 = parseInt(dat.toEnglishDigit());
                console.log(dat1);
                newdate = convertTimeStampToJalali(dat1);
                td[i].innerText = newdate;
            }
        }

        dateP();
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
                        url: "{{route('program.delete')}}",
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
    </script>
    <script src="{{asset('plugins/newdatatable/datatables.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myTable').DataTable({
                language: {
                    "info": " _START_ تا _END_ از _TOTAL_ ",
                    paginate: {
                        next: 'بعدی', // or '→'
                        previous: 'قبلی' // or '←'
                    },
                    "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                    "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                    "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                    "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "نمایش _MENU_ رکورد",
                    "sLoadingRecords": "در حال بارگزاری...",
                    "sProcessing": "در حال پردازش...",
                    "sSearch": "جستجو:",
                    "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                    "oPaginate": {
                        "sFirst": "ابتدا",
                        "sLast": "انتها",
                        "sNext": "بعدی",
                        "sPrevious": "قبلی"
                    }, "oExport": {
                        "sPrint": "ابتدا",
                    },
                    "oAria": {
                        "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                        "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i><span> کپی کردن</span>',
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i><span> خروجی excel</span>',
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i><span> چاپ</span>',
                        customize: function (win) {
                            $(win.document.body)
                                .css('direction', 'rtl')
                                .prepend(
                                    '<img src="{{ asset('/images/logo/logo-min2.png') }}" style="position:absolute; top:0; right:0;left: 0;margin: 0 auto;display: block;opacity: .05" />'
                                );

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    },
                ]
            });
        });
    </script>
@endsection
