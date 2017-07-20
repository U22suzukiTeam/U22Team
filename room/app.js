var express = require('express'),
    app = express(),
    server = require('http').createServer(app),
    io = require("socket.io").listen(server);

server.listen(8080);

app.get('/', function(req, res) {
	app.use(express.static(__dirname));

    res.sendfile(__dirname + '/index.html');

});

io.sockets.on('connection', function(socket) {

    socket.on('send message', function(data) {

        io.sockets.emit('new message', data);

    });

});
