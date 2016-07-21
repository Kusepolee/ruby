<?php
?>
@extends('head')

@section('content')

    <div class="container">
        <div id="page-wrapper" class="col-md-8">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"><a href="/finance">资金支出</a></h1>
                        <h1 class="page-subhead-line"><span style="font-size:15px; color:#8C8C8C; font-weight:200;">支出人: {{ $rec->userName }}</span></h1>
                    </div>
                </div>
                    <div class="col-md-16">
                        <div class="alert alert-info">
                            <p>金额: ¥ {{ floatval($rec->out_amount) }}</p>
                            <p>部门: {{ $rec->dpName }}</p>
                            <p>票据: {{ $rec->outBill }}</p>
                            <p>日期: {{ $rec->out_date }}</p>
                            <p>用途: {{ $rec->out_item }}</p>
                        </div>
                    </div>
            </div>
        </div>
        
    </div>

@endsection