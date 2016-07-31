// var fs = require('fs');
// var app = require('express')();
// var http = require('https').Server(app);
// var options = {
//   key: fs.readFileSync('/etc/letsencrypt/live/henjou.com/privkey.pem'),
//   cert: fs.readFileSync('/etc/letsencrypt/live/henjou.com/fullchain.pem')
// };
// var io = require('socket.io')(http);
// var Redis = require('ioredis');
// var redis = new Redis();
// redis.subscribe('message-channel', function(err, count) {
// });
// redis.on('message', function(channel, message) {
//     console.log('Message Recieved: ' + message);
//     message = JSON.parse(message);
//     io.emit(channel + ':' + message.event, message.data);
// });
// http.listen(3000, function(){
//     console.log('Listening on Port 3000');
// });

var fs = require('fs');
var https = require('https');

var express = require('express');
var app = express();

var options = {
  key: fs.readFileSync('/etc/letsencrypt/live/henjou.com/privkey.pem'),
  cert: fs.readFileSync('/etc/letsencrypt/live/henjou.com/fullchain.pem')
};
// var serverPort = 443;
var server = https.createServer(options, app);
var io = require('socket.io')(server);

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

// app.get('/', function(req, res) {
//   res.sendFile(__dirname + '/public/index.html');
// });

// io.on('connection', function(socket) {
//   console.log('new connection');
//   socket.emit('message', 'This is a message from the dark side.');
// });

// server.listen(serverPort, function() {
//   console.log('server up and running at %s port', serverPort);
// });