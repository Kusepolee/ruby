<?php

if(Session::has('id')) $S_id = Session::get('id');

?>
@extends('head')

@section('content')

    <div class="container">
        <div id="page-wrapper" class="col-md-8">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        @if($S_id != $rec->tran_from && $S_id != $rec->tran_to)
                        <h1 class="page-head-line"><a href="/finance">资金往来</a></h1>
                        @else
                            @if($S_id != $rec->tran_from)
                            <h1 class="page-head-line"><a href="/finance">收到</a></h1>
                            @else
                            <h1 class="page-head-line"><a href="/finance">给予</a></h1>
                            @endif
                        @endif
                        <h1 class="page-subhead-line"><span style="font-size:15px; color:#8C8C8C; font-weight:200;">{{ $rec->fromName }} --> {{ $rec->toName }}</span></h1>
                    </div>
                </div>
                    <div class="col-md-16">
                        <div class="alert alert-info">
                            <p>金额: ¥ {{ floatval($rec->tran_amount) }}</p>
                            <p>方式: {{ $rec->tranType }}</p>
                            <p>日期: {{ $rec->tran_date }}</p>
                            <p>用途: {{ $rec->tran_item }}</p>
                            <p>登记日期: {{ $rec->created_at }}</p>
                        </div>
                    </div>
                    @if($S_id != $rec->tran_from && $S_id != $rec->tran_to)
                        <p></p>
                    @else
                        @if($S_id != $rec->createdBy)
                            @if($rec->tran_state != 1)
                            <div class="col-md-16">
                                <h1 class="page-subhead-line"></h1>
                                <p><span style="font-size:15px; color:#8C8C8C; font-weight:200;">若确认信息无误,点击确认</span></p>
                                <a href="/finance/trans/confirm/{{ $rec->id }}" class="btn btn-success">确认</a>
                            </div>
                            @endif
                        @endif
                    @endif
            </div>
        </div>
        
    </div>

@endsection