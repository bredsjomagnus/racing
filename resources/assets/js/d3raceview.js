function getPathParameter() {
	var pathname = window.location.pathname;
	var patharray = pathname.split("/");

	return patharray[patharray.length -1];
}
var raceid = getPathParameter();
var jsonurl = '';
if(window.location.host == 'localhost') {
	jsonurl = 'http://localhost/pwww/Race/public/api/race/'+raceid;
} else {
	jsonurl = 'http://206.81.18.153/api/race/'+raceid;
}
// console.log(jsonurl);
var margin = { left:100, right:150, top:0, bottom:100 },
    height = 700 - margin.top - margin.bottom,
    width = 700 - margin.left - margin.right;

var svg = d3.select("#raceview-area").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom);

var g = svg.append("g")
    .attr("transform", "translate(" + margin.left +
        ", " + margin.top + ")");

var size = d3.scaleLinear()
			.range([10, 12]);

var linelength = d3.scaleLinear()
			.range([0, 140]);

var tree = d3.tree()
    .size([height, width - 300]);

d3.json(jsonurl).then(function(data){

	// console.log("data: " , data);
	// console.log("data: " , data[0].place);
	// console.log("data: " , data[0].date.substring(0,10));
	var raceplace = data[0].place;

	// Get max and min laps in race
	let allaps = [...(data.map(item => item.laps))];
	var maxlaps = Math.max.apply(Math, allaps);
	var minlaps = Math.min.apply(Math, allaps);

	size.domain([minlaps, maxlaps]);
	linelength.domain([minlaps,maxlaps]);
	// Ta ut alla unika klasser.
	let uniqueclasses = [...new Set(data.map(item => item.class))];

	// Rensa bort eventuella tomma klasser.
	var index = uniqueclasses.indexOf("");
	if (index > -1) {
	  uniqueclasses.splice(index, 1);
	}
	uniqueclasses.sort();

	// console.log(uniqueclasses);
	// Formatera om data.
	// Sätt en root node som start.
	var formatedData = {root: "rootelement", name: raceplace };
	var children = [];
	uniqueclasses.forEach((uc) => {
		const filterresult = data.filter( d => (d.class == uc) );
		let teams = [...(filterresult.map(item => item.teamname))];
		let teamlaps = [...(filterresult.map(item => item.laps))];
		// console.log("filterresult: " , filterresult);
		// console.log("uniqueteams: " + uniqueteams);
		// console.log("uniquelaps: " + uniquelaps);
		var childvalue = [];
		for(var i = 0; i < teams.length; i++) {
			childvalue.push({
				name: teams[i],
				laps: teamlaps[i]
			})
		}
		// uniqueteams.forEach((ut) => {
		// 	childvalue:
		// })
		child = { name: uc, children: childvalue }
		children.push(child);
	});
	formatedData.children = children;
	// console.log("formatedData: " , formatedData);
	//
	var hierachy_data = d3.hierarchy(formatedData);


	// // // console.log("nested_data: " , nested_data);
	// console.log("hierarcy_data: " , hierachy_data);
	// // // // var root = hierachy_data;
	// console.log(tree(hierachy_data).links());
	// console.log("hierachy_data.descendants(): " , hierachy_data.descendants());

  //
	// console.log("hierachy_data.ancestors: " + hierachy_data.ancestors);

  var link = g.selectAll(".link")
    .data(tree(hierachy_data).links())
    .enter().append("path")
      .attr("class", "link")
      .attr("d", d3.linkHorizontal()
          .x(function(d) {
			  if(d.children) {
				  return d.y;
			  } else {
				  return (d.y + linelength(d.data.laps))
			  }
			   })
          .y(function(d) { return d.x; }));

  var node = g.selectAll(".node")
    .data(hierachy_data.descendants())
    .enter().append("g")
      .attr("class", function(d) { return "node" + (d.children ? " node--internal" : " node--leaf"); })
      .attr("transform", function(d) {
		  if(d.children) {
			  return "translate(" + d.y + "," + d.x + ")";
		  } else {
			  return "translate(" + (d.y + linelength(d.data.laps)) + "," + d.x + ")";
		  }
	  });


  node.append("circle")
      .attr("r", 2.5);

  node.append("text")
      .attr("dy", 3)
      .attr("x", function(d) {
		  if(d.data.root) {
			  return -8
		  } else if(d.children) {
			  return 0;
		  } else {
			  return 8;
		  }
	 	})
	  .attr("y", function(d) { return d.children && !d.data.root ? -10 : 0; })
	  .style("text-anchor", function(d) {
		  if(d.data.root) {
			  return "end";
		  } else if(d.children) {
			  return "middle";
		  } else {
			  return "start";
		  }
	  })
      .style("font-size", function(d) { return d.children ? "11px" : size(d.data.laps) + "px"; })
      .text(function(d) {
		  return d.data.laps != null ? d.data.name + " - Laps: " + d.data.laps : d.data.name;
	  });
}).catch((error) => {
	console.log(error);
});
