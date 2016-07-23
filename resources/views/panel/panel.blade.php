@extends('head')

@section('content')

 <div class="container">
 {{-- advice --}}
    <div class="col-md-2 col-sm-4 col-xs-4 wel-grid text-center">
        <div class="btm-clr"><a href="/panel/complaints">
            <figure id="tubiao" class="icon">
                <span class="tubiao yanse glyphicon glyphicon-send" aria-hidden="true"></span>
            </figure></a>
            <h5>投诉建议</h5>
        </div>
    </div>
    {{-- end of advice --}}

    {{-- out proof --}}
    <div class="col-md-2 col-sm-4 col-xs-4 wel-grid btm-gre text-center">
        <div class="btm-clr"><a href="/panel/proof">
            <figure id="tubiao1" class="icon">
                <span class="tubiao yanse1 glyphicon glyphicon-log-out" aria-hidden="true"></span>
            </figure></a>
            <h5>出门证</h5>
        </div>
    </div>
    {{-- end of out proof --}}

    {{-- rules --}}
    <div class="col-md-2 col-sm-4 col-xs-4  wel-grid text-center">
        <div class="btm-clr"><a href="/panel/rules">
            <figure id="tubiao2" class="icon">
                <span class="tubiao yanse2 glyphicon glyphicon-duplicate" aria-hidden="true"></span>
            </figure></a>
            <h5>规章制度</h5>
        </div>
    </div>
    {{-- end fo rules --}}

    {{-- check --}}
    <div class="col-md-2 col-sm-4 col-xs-4  wel-grid text-center">
        <div class="btm-clr"><a href="/panel/member/check">
            <figure id="tubiao2" class="icon">
                <span class="tubiao yanse2 glyphicon glyphicon-time" aria-hidden="true"></span>
            </figure></a>
            <h5>考勤登记</h5>
        </div>
    </div>
    {{-- check --}}

    {{-- config --}}
    <div class="col-md-2 col-sm-4 col-xs-4  wel-grid text-center">
        <div class="btm-clr"><a href="/panel/config">
            <figure id="tubiao2" class="icon">
                <span class="tubiao yanse2 glyphicon glyphicon-cog" aria-hidden="true"></span>
            </figure></a>
            <h5>系统设置</h5>
        </div>
    </div>
    {{-- config --}}

</div>  	
@endsection