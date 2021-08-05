@extends('layouts.admin')
@section('crump')

    <div class="content-header p-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">  گزارش عملکرد طبقات </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('panel') }}">خانه</a></li>
                        <li class="breadcrumb-item active">  گزارش عملکرد طبقات</li>
                    </ol>
                </div><!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('main')
    <div class="card-header">
        <h5>
            گزارش عملکرد طبقات
        </h5>
    </div>
    <div class="card-body">
        @for($i=0;$i<count($data);$i++)
            <div class="row">
                <div class="col-6 col-md-4 p-2 text-center">
                    <input type="text" class="knob" value="{{ceil($percent[$i])}}" data-width="90" data-height="90"
                           data-fgColor="#00c0ef"
                           data-readonly="true">
                    <div class="knob-label"><a href="#" data-html="true" data-toggle="tooltip" data-placement="top"
                                               title="
                        کد طبقه : {{$data[$i]['code']}} <br>
                            تعداداقدامات : {{$act[$i]}} <br>
تعداد راهبرد ها :{{$stra[$i]}}  <br>
اقدامات تایید شده : {{$dact[$i]}}
                                                   ">{{$data[$i]['name']}}</a></div>
                    <div class="knob-label">درصد تحقق :{{ceil($percent[$i])}}%</div>

                </div>

                @if($i<count($data)-1)
                    @php($i++)
                    <div class="col-6 col-md-4 p-2 text-center">
                        <input type="text" class="knob" value="{{ceil($percent[$i])}}" data-width="90" data-height="90"
                               data-fgColor="#00c0ef"
                               data-readonly="true">

                        <div class="knob-label"><a href="#" data-html="true" data-toggle="tooltip" data-placement="top"
                                                   title="
                        کد طبقه : {{$data[$i]['code']}} <br>
                            تعداداقدامات : {{$act[$i]}} <br>
تعداد راهبرد ها :{{$stra[$i]}}  <br>
اقدامات تایید شده : {{$dact[$i]}}
                                                       ">{{$data[$i]['name']}}</a></div>
                        <div class="knob-label">درصد تحقق :{{ceil($percent[$i])}}%</div>

                    </div>

                @endif
                @if($i<count($data)-1)
                    @php($i++)
                    <div class="col-6 col-md-4 p-2 text-center">
                        <input type="text" class="knob" value="{{ceil($percent[$i])}}" data-width="90" data-height="90"
                               data-fgColor="#00c0ef"
                               data-readonly="true">

                        <div class="knob-label"><a href="#" data-html="true" data-toggle="tooltip" data-placement="top"
                                                   title="
                        کد طبقه : {{$data[$i]['code']}} <br>
                            تعداداقدامات : {{$act[$i]}} <br>
تعداد راهبرد ها :{{$stra[$i]}}  <br>
اقدامات تایید شده : {{$dact[$i]}}
                                                       ">{{$data[$i]['name']}}</a></div>
                        <div class="knob-label">درصد تحقق :{{ceil($percent[$i])}}%</div>

                    </div>
                @endif

            </div>
    @endfor
    <!-- ./col -->
    </div>

@endsection
@section('script')
    <script type='text/javascript'>//<![CDATA[
        $(function () {
            /* jQueryKnob */

            $('.knob').knob({
                /*change : function (value) {
                 //console.log("change : " + value);
                 },
                 release : function (value) {
                 console.log("release : " + value);
                 },
                 cancel : function () {
                 console.log("cancel : " + this.value);
                 },*/
                draw: function () {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        var a = this.angle(this.cv)  // Angle
                            ,
                            sa = this.startAngle          // Previous start angle
                            ,
                            sat = this.startAngle         // Start angle
                            ,
                            ea                            // Previous end angle
                            ,
                            eat = sat + a                 // End angle
                            ,
                            r = true

                        this.g.lineWidth = this.lineWidth

                        this.o.cursor
                        && (sat = eat - 0.3)
                        && (eat = eat + 0.3)

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value)
                            this.o.cursor
                            && (sa = ea - 0.3)
                            && (ea = ea + 0.3)
                            this.g.beginPath()
                            this.g.strokeStyle = this.previousColor
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                            this.g.stroke()
                        }

                        this.g.beginPath()
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                        this.g.stroke()

                        this.g.lineWidth = 2
                        this.g.beginPath()
                        this.g.strokeStyle = this.o.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                        this.g.stroke()

                        return false
                    }
                }
            })
        /* END JQUERY KNOB */

        //INITIALIZE SPARKLINE CHARTS

        // We could use setInterval instead, but I prefer to do it this way
    </script>
@endsection
