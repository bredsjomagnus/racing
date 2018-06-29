/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function getPathParameter() {
	var pathname = window.location.pathname;
	var patharray = pathname.split("/");

	return patharray[patharray.length - 1];
}
var raceid = getPathParameter();
var jsonurl = '';
if (window.location.host == 'localhost') {
	jsonurl = 'http://localhost/pwww/Race/public/api/race/' + raceid;
} else {
	jsonurl = 'http://206.81.18.153/api/race/' + raceid;
}
console.log(jsonurl);
var margin = { left: 80, right: 100, top: 50, bottom: 100 },
    height = 800 - margin.top - margin.bottom,
    width = 800 - margin.left - margin.right;

var svg = d3.select("#raceview-area").append("svg").attr("width", width + margin.left + margin.right).attr("height", height + margin.top + margin.bottom);

var g = svg.append("g").attr("transform", "translate(" + margin.left + ", " + margin.top + ")");

var tree = d3.tree().size([height, width - 300]);

d3.json(jsonurl).then(function (data) {

	console.log("data: ", data);
	console.log("data: ", data[0].place);
	console.log("data: ", data[0].date.substring(0, 10));
	var raceplace = data[0].place;

	// Ta ut alla unika klasser.
	var uniqueclasses = [].concat(_toConsumableArray(new Set(data.map(function (item) {
		return item.class;
	}))));

	// Rensa bort eventuella tomma klasser.
	var index = uniqueclasses.indexOf("");
	if (index > -1) {
		uniqueclasses.splice(index, 1);
	}
	uniqueclasses.sort();

	console.log(uniqueclasses);
	// Formatera om data.
	// Sätt en root node som start.
	var formatedData = { name: raceplace, laps: '' };
	var children = [];
	uniqueclasses.forEach(function (uc) {
		var filterresult = data.filter(function (d) {
			return d.class == uc;
		});
		var uniqueteams = [].concat(_toConsumableArray(new Set(filterresult.map(function (item) {
			return item.teamname;
		}))));
		child = { name: uc, children: uniqueteams };
		children.push(child);
	});
	formatedData.children = children;
	console.log(formatedData);
	//
	var hierachy_data = d3.hierarchy(formatedData);
	// // // console.log("nested_data: " , nested_data);
	// console.log("hierarcy_data: " , hierachy_data);
	// // // // var root = hierachy_data;
	// console.log(tree(hierachy_data).links());
	// console.log("hierachy_data.descendants(): " , hierachy_data.descendants());

	//
	var link = g.selectAll(".link").data(tree(hierachy_data).links()).enter().append("path").attr("class", "link").attr("d", d3.linkHorizontal().x(function (d) {
		return d.y;
	}).y(function (d) {
		return d.x;
	}));

	var node = g.selectAll(".node").data(hierachy_data.descendants()).enter().append("g").attr("class", function (d) {
		return "node" + (d.children ? " node--internal" : " node--leaf");
	}).attr("transform", function (d) {
		return "translate(" + d.y + "," + d.x + ")";
	});

	node.append("circle").attr("r", 2.5);

	node.append("text").attr("dy", 3).attr("x", function (d) {
		return d.children ? -8 : 8;
	}).style("text-anchor", function (d) {
		return d.children ? "end" : "start";
	}).text(function (d) {
		return d.data.name != null ? d.data.name : d.data;
	});
}).catch(function (error) {
	console.log(error);
});

/***/ })

/******/ });