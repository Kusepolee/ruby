@extends('head')

@section('content')

 <div class="container">
 {{-- advice --}}
    <div class="col-md-2 col-sm-4 col-xs-4 wel-grid text-center">
        <div class="btm-clr"><a href="panel/complaints">
            <figure id="tubiao" class="icon">
                <span class="tubiao yanse glyphicon glyphicon-send" aria-hidden="true"></span>
            </figure></a>
            <h5>投诉建议</h5>
        </div>
    </div>
    {{-- end of advice --}}

    {{-- out proof --}}
    <div class="col-md-2 col-sm-4 col-xs-4 wel-grid btm-gre text-center">
        <div class="btm-clr"><a href="panel/proof">
            <figure id="tubiao1" class="icon">
                <span class="tubiao yanse1 glyphicon glyphicon-log-out" aria-hidden="true"></span>
            </figure></a>
            <h5>出门证</h5>
        </div>
    </div>
    {{-- end of out proof --}}

    {{-- rules --}}
    <div class="col-md-2 col-sm-4 col-xs-4  wel-grid text-center">
        <div class="btm-clr"><a href="panel/rules">
            <figure id="tubiao2" class="icon">
                <span class="tubiao yanse2 glyphicon glyphicon-duplicate" aria-hidden="true"></span>
            </figure></a>
            <h5>规章制度</h5>
        </div>
    </div>
    {{-- end fo rules --}}

</div>  	
@endsection