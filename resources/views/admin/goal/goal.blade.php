@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">لیست اهداف</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">لیست اهداف</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')

    <div class="card-header">
        <span class="card-title" style="padding-left: 2%">لیست اهداف</span>
        <a href="{{route('goal.create')}}" class="btn btn-sm btn-outline-info d-inline-block"
           style="height: 26px;width: 30px;"><i class="fa fa-plus"></i></a>

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
                <th>کد هدف</th>
                <th>بیشتر</th>
            </tr>
            </thead>
            <tbody>
            @if(!isset($_GET['page']))
                @php($i=1 )
            @else
                @php($i=(1*$_GET['page']*10)-9)
            @endif
            @foreach($data as $d)
                <tr>
                    <td style="width: 5%">{{$i++}}</td>
                    <td style="width: 55%">{{$d['title']}}</td>
                    <td style="width: 20%">{{$d['code']}}</td>
                    <td>
                        <a class="edit" data-toggle="tooltip" data-placement="top"  title="ویرایش" href="{{route('goal.edit',$d['id'])}}"><i style="font-size: 20px" class="fa fa-edit"></i></a>
                        <a data-toggle="tooltip" data-placement="top"  title="حذف این مورد !"  href="#" style="color: red;" class="trashbtn" data-id="{{$d['id']}}"><i style="font-size: 20px" class="fa fa-trash"></i></a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <div name="csrf-token" content="{{ csrf_token() }}" ></div>
    </div>


@endsection
@section('script')

<script>
    $(document).on('click', '.trashbtn', function (e) {
        let _token   = $('div[name="destroy"]').attr('content');
        e.preventDefault();
        var id = $(this).data('id');
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
                    url: "{{route('goal.delete')}}",
                    data: {id:id,_token: _token},
                    success: function (data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'حذف رکورد از دیتابیس با موفقیت انجام شد !',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){
                            window.location.reload();
                        }, 1800);

                    }
                });
            }
        })
            // function() {
            //
            // });
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
