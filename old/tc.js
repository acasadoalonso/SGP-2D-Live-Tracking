

var json = require('./config.json');
function getapparea()
{
	var appareaogn  =  "&ne_lat="+json.bounds.ne_lat+"&ne_lon="+json.bounds.ne_lon+"&sw_lat="+json.bounds.sw_lat+"&sw_lon="+json.bounds.sw_lon+"&activeFlarm=";
	return(appareaogn);
}

function getappurl()
{
	var appurl   =  'http://'+json.socket.server;
	return(appurl);
}
function getappport()
{
	return(json.socket.port);
}

console.log(getappurl())
console.log(getappport())
console.log(getapparea())
