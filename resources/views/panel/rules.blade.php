@extends('head')

@section('content')

 <div class="container">
	<div id="page-wrapper">
        <div id="page-inner">
        	<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4><a href="">总章</a></h4>
                        </div>
                        <div class="panel-body">
                            <blockquote>
                                <h5>为输入框组添加按钮需要额外添加一层嵌套，不是 .inut-grou-addon，而是添加 .inut-grou-btn 来包裹按钮元素。由于不同浏览器的默认样式无法被统一的重新赋值，所以才需要这样做。</h5>
                                <small><a class="btn btn-xs btn-default pull-right" href="">修改</a></small>
                            </blockquote>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection