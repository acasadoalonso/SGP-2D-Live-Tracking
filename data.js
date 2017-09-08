var util = require("util"),
    http = require("http");
    https = require("https");

var fs = require('fs'),
    ini = require('ini');
var request = require("request");

var options = {
  key: fs.readFileSync('/var/www/html/node/file.pem'),
  cert: fs.readFileSync('/var/www/html/node/file.crt')
};

var configdir = process.env.CONFIGDIR;
if (configdir == undefined){
	configdir = process.env.configdir;
	if (configdir == undefined){
		configdir='/etc/local/';
		}
	}
var os = require("os");
var hostname = os.hostname();
console.log(configdir + ' at '+ hostname);
var config  = ini.parse(fs.readFileSync(configdir+'APRSconfig.ini', 'utf-8'))
var AppUrl  =  "https://"+config.server.AppUrl;
if (hostname == "UBUVM"){
	AppUrl  =  "https://localhost";
}
var AppPort =  config.server.AppPort;
console.log(AppUrl + ':'+ AppPort);
//var AppArea =  config.server.AppArea;
var AppArea =  	"&ne_lat=" + config.server.AppNeLat + 
		"&ne_lon=" + config.server.AppNeLon + 
		"&sw_lat=" + config.server.AppSwLat + 
		"&sw_lon=" + config.server.AppSwLon + 
		"&activeFlarm="
console.log(AppUrl)

/*var app = require('https').createServer({
    key: fs.readFileSync('/var/www/html/node/file.pem'),
    cert: fs.readFileSync('/var/www/html/node/file.crt'),
  	passphrase: ''
},handler);

var io = require('socket.io').listen(app,{
	"log level": 3
	, log: true
    , "pingTimeout": 15000
    , "pingInterval": 20000
});
app.listen(AppPort);
*/
var options = {
    key: fs.readFileSync('/var/www/html/node/certs/privkey.pem'),
    cert: fs.readFileSync('/var/www/html/node/certs/cert.pem')
};
var https = require('https').createServer(options);
var io = require('socket.io').listen(https);
https.listen(AppPort, function(){
	console.log('Server started at port: ' + AppPort);	
});



//var io = require('socket.io')(AppPort);



var sockets=0, desktop=0, mobile=0;
io.on('connection', function (socket) {
	console.log("TRY")
  	var handshakeData = socket.request;
  	if(handshakeData._query['platform']){
		if(handshakeData._query['platform']=="desktop") desktop++;
		if(handshakeData._query['platform']=="mobile") mobile++;	
	}
	sockets++;
	var d = new Date();
	console.log("Active CNX : Total:" + sockets + "; Mobile:" + mobile + "; Desktop:" + desktop + " Date: " + d);
	//io.emit('data', { hello: 'world' });
	
	//socket.on('echo', function (data, response) {
	//	response(data);
	//});
	
	socket.on('disconnect', function () {
	  	var handshakeData = socket.request;		
		if(handshakeData._query['platform']=="desktop") desktop--;
		if(handshakeData._query['platform']=="mobile") mobile--;	
		sockets--;
		d = new Date();
		console.log("Active CNX : Total:" + sockets + "; Mobile:" + mobile + "; Desktop:" + desktop + " Date: " + d);
	
	});
  
});
io.on('disconnect', function (socket) {
	console.log("DCNX:" + socket.id);
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

function handler (req, res) {
  fs.readFile(__dirname + '/index.html',
  function (err, data) {
    if (err) {
		try{
			res.writeHead(500);
		}catch(e){
		
		}
		return res.end('Error loading index.html');
    }

    try{
		res.writeHead(200);
    }catch(e){
	
	}
	res.end(data);
  });
}
