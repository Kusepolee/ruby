<?php
$h = new FooWeChat\Helpers\Helper;
$socket = $h->app('ssl').'://'.$h->custom('url').':3000';
$h->app('ssl') == 'https' ? $socket_ssl = ', {secure: true}' : $socket_ssl='';
?>
@extends('head')

@section('content')
<p id="power">0</p>

<script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
<script>
        //var socket = io('http://localhost:3000');
        var socket = io('<?php echo $socket; ?>'<?php echo $socket_ssl; ?>);
        socket.on("message-channel:App\\Events\\MessageEvent", function(message){
            // increase the power everytime we load test route
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        });
</script>
@endsection