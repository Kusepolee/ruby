// https server ssl服务器
// ---------------------

var fs = require('fs');
var app = require('express')();
var options = {
  key: fs.readFileSync('/etc/letsencrypt/live/henjou.com/privkey.pem'),
  cert: fs.readFileSync('/etc/letsencrypt/live/henjou.com/fullchain.pem')
};
var https = require('https').Server(options,app);

var io = require('socket.io')(https);
var Redis = require('ioredis');
var redis = new Redis();
redis.subscribe('message-channel', function(err, count) {
});
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
https.listen(3000, function(){
    console.log('Listening on Port 3000');
});

//http 服务器
//-----------

// var app = require('express')();
// var http = require('http').Server(app);
// var io = require('socket.io')(http);
// var Redis = require('ioredis');
// var redis = new Redis();
// redis.subscribe('test-channel', function(err, count) {
// });
// redis.on('message', function(channel, message) {
//     console.log('Message Recieved: ' + message);
//     message = JSON.parse(message);
//     io.emit(channel + ':' + message.event, message.data);
// });
// http.listen(3000, function(){
//     console.log('Listening on Port 3000');
// });