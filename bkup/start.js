var forever = require('forever-monitor');
var fs = require('fs');
var copy=require('child_process').exec;

var child; 
var ping;

if(1==1){    
	child = new (forever.Monitor)('/var/www/html/node/data.js', {
		'silent': false,
		'args': [], 
		'spinSleepTime': 20000, 
		'watch': false,
//		'watchDirectory': '/var/www/html/node/', 
		'killTree': true
	}); 
	child.on('exit', function () {  
		//console.log('your-filename.js has exited after 3 restarts'); 
	});
	child.on('restart ', function () {
		//log(chalk.red('APP ON RESTART'));  
	});   
	child.on('stdout', function (data) { 
		//console.log(chalk.stripColor(data));
	});  
	child.start(); 
}


