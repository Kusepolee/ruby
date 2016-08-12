<?php
?>
@extends('head')

@section('content')

    <div class="container">
        <div id="page-wrapper" class="col-md-8">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"><a href="/panel/delivery">{{ $rec->name }}</a></h1>
                        <h1 class="page-subhead-line"><span style="font-size:15px; color:#8C8C8C; font-weight:200;">{{ floatval($rec->amount) }} {{ $rec->unitName }}</span></h1>
                    </div>
                </div>
                    <div class="col-md-16">
                        <div class="alert alert-info">
                            <p>发货日期: {{ $rec->date }}</p>
                            <p>发货人: {{ $rec->sender }}</p>
                            <p>收货人: {{ $rec->receiver }}</p>
                            <p>收货单位: {{ $rec->company }}</p>
                            <p>备注: {{ $rec->content }}</p>
                            <p>登记人: {{ $rec->createByName }}</p>
                            <p>登记日期: {{ $rec->created_at }}</p>
                        </div>
                    </div>
            </div>
        </div>
        
    </div>

@endsection