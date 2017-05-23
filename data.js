var util = require("util"),
    http = require("http");

var fs = require('fs'),
    ini = require('ini');
var request = require("request");
var config  = ini.parse(fs.readFileSync('/etc/local/APRSconfig.ini', 'utf-8'))
var AppUrl  =  "http://"+config.server.AppUrl;
var AppArea =  config.server.AppArea;
var AppArea =  	"&ne_lat=" + config.server.AppNeLat + 
		"&ne_lon=" + config.server.AppNeLon + 
		"&sw_lat=" + config.server.AppSwLat + 
		"&sw_lon=" + config.server.AppSwLon + 
		"&activeFlarm="

var io = require('socket.io')(81);
var sockets=0, desktop=0, mobile=0;
io.on('connection', function (socket) {

  	var handshakeData = socket.request;
  	if(handshakeData._query['platform']){
		if(handshakeData._query['platform']=="desktop") desktop++;
		if(handshakeData._query['platform']=="mobile") mobile++;	
	}
	sockets++;
	console.log("Active CNX : Total:" + sockets + "; Mobile:" + mobile + "; Desktop:" + desktop);
	//io.emit('data', { hello: 'world' });
	
	//socket.on('echo', function (data, response) {
	//	response(data);
	//});
	
	socket.on('disconnect', function () {
	  	var handshakeData = socket.request;		
		if(handshakeData._query['platform']=="desktop") desktop--;
		if(handshakeData._query['platform']=="mobile") mobile--;	
		sockets--;
		console.log("Active CNX : Total:" + sockets + "; Mobile:" + mobile + "; Desktop:" + desktop);
	
	});
  
});

setInterval(function(){
	var url=AppUrl + "/node/data.php?clients=" + sockets + AppArea;
	request(url, function(err, resp, body){
	  try{io.sockets.emit("data", JSON.parse(body));}catch(e){}
	});
	
},2000)

net = require('net');

// Keep track of the chat clients
var clients = [];

// Start a TCP Server
net.createServer(function (socket) {

  // Identify this client
  socket.name = socket.remoteAddress + ":" + socket.remotePort 

  // Put this new client in the list
  clients.push(socket);

  // Send a nice welcome message and announce
  socket.write("Welcome " + socket.name + "\n");
  broadcast(socket.name + " joined the chat\n", socket);

  // Handle incoming messages from clients.
  socket.on('data', function (data) {
    //broadcast(socket.name + "> " + data, socket);
	
	data=data.toString('utf8');
	data = data.replace(/(\r\n|\n|\r)/gm,"");
	
	if(data=="LIST"){
		 broadcast("Active CNX :" + sockets);
	}
	if(data=="EXIT"){
		 broadcast("Good bye!");
	}
  });

  // Remove the client from the list when it leaves
  socket.on('end', function () {
    clients.splice(clients.indexOf(socket), 1);
    broadcast(socket.name + " left the chat.\n");
  });
  
  // Send a message to all clients
  function broadcast(message, sender) {
    clients.forEach(function (client) {
      // Don't want to send it to sender
      if (client === sender) return;
      client.write(message);
    });
    // Log it to the server output too
    process.stdout.write(message)
  }

}).listen(5000);

