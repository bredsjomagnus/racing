require('./bootstrap');

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function getPathParameter() {
	var pathname = window.location.pathname;
	var patharray = pathname.split("/");

	return patharray[patharray.length -1];
}


var raceid = getPathParameter();
var teamid = getParameterByName('teamid');

console.log("teamid: " + teamid);
console.log("raceid: " + raceid);



const widthinput = 600;
const heightinput = 400;

var margin = {
		top: 10,
		right: 10,
		bottom: 70,
		left: 100
	};

var width = widthinput - margin.left - margin.right,
	height = heightinput - margin.top - margin.bottom;

var g = d3.select("#chart-area")
		.append("svg")
			.attr("width", width + margin.left +  margin.right)
			.attr("height", height + margin.top + margin.bottom)
		.append("g")
			.attr("transform", "translate(" + margin.left + ", " + margin.top + ")");


var xAxisCall = d3.axisBottom();
var yAxisCall = d3.axisLeft();

var xAxis = g.append("g")
	.attr("class", "x axis")
	.attr("transform", "translate(0, "+ height +")");

xAxis.append("text")
	.attr("x", width/2)
	.attr("y", height + 50)
	.attr("font-size", "20px")
	.attr("text-anchor", "middle")
	.text("Varv");

var yAxis = g.append("g");

yAxis.append("text")
	.attr("x", - height/2)
	.attr("y", - 40)
	.attr("font-size", "20px")
	.attr("text-anchor", "middle")
	.text("Hastighet (km/h)");

	var x = d3.scaleLinear()
				.range([0, width]);

	var y = d3.scaleLinear()
				.range([height, 0]);

var line = d3.line()
	.x(function(d) { return x(d.laps); }) // set the x values for the line generator
	.y(function(d) { return y(d.speed); }) // set the y values for the line generator
	.curve(d3.curveMonotoneX); // apply smoothing to the line

d3.json('http://localhost/pwww/Race/public/api/team/'+raceid+'?teamid='+teamid).then(function(data) {

	var n = d3.max(data, (d) => {
		return d.laps;
	});

	console.log(data);

	x.domain([0, n]);
	y.domain([0, d3.max(data, (d) => {
		return d.speed*1.5;
	})]);


	xAxis.call(xAxisCall.scale(x));
	yAxis.call(yAxisCall.scale(y));



	// var dataset = d3.range(n).map(function(d) { return {"y": yScale(d.speed) } });

	g.append("path")// Assign a class for styling
		.attr("class", "line")
		.attr("fill", "none")
		.attr("stroke", "gray")
		.attr("stroke-width", "3px")
		.attr("d", line(data));

	// var circels = g.selectAll('circle')
	// 	.data(data)
	// 	.enter()
	// 		.append('circle')
	// 			.attr("cx", (d) => {
	// 				return x(d.laps);
	// 			})
	// 			.attr("cy", (d) => {
	// 				// console.log(i);
	// 				return y(d.speed);
	// 			})
	// 			.attr("r", 2)
	// 			.attr("fill", "gray");
}).catch(function(error) {
	console.log(error);
});
