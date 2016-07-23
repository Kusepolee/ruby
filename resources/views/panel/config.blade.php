@extends('head')

@section('content')
<div class="container">
	{{-- 面包屑 --}}
    <ol class="breadcrumb">
	    <li><a href="/panel" class="btn btn-xs btn-info">返回工作面版</a></li>
    </ol>
    {{-- 面包屑 --}}

    {{-- 图标区 --}}
    <a href="/panel/config/work_time" class="btn btn-ms btn-info">工作时间</a>
    {{-- 图标区 --}}
</div>
@endsection