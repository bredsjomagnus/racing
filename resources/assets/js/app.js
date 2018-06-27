
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Event = new Vue();

Vue.component('progressview', {
	data() {
		return {
			completionRate: 10
		}
	}
});

Vue.filter('capitalize', function(value){
	return value.toUpperCase();
});

let mylapsapp = new Vue({
	el: '#mylapstable',

	data: {
		search: '',
		raceid: '',
		sortKey: 'elapsed_time',
		sortOrder: 'asc',
	    reverse: false,
	    columns: ['no', 'name', 'laps', 'lead', 'lap_time', 'speed', 'elapsed_time', 'passing_time', 'hits', 'strength', 'noice', 'transponder', 'class', 'deleted'],
		res: []
	},
	computed: {
		filteredTracks(){
			return this.res.filter((row) => {
				let transp = false;
				let sp = false;
				let na = false;
				let ca = false;
				if(row.transponder) {
					transp = row.transponder.toString().match(this.search);
				}
				if(row.speed) {
					sp = row.speed.toString().match(this.search);
				}
				if(row.name) {
					na = row.name.toLowerCase().match(this.search.toLowerCase());
				}
				if(row.class) {
					ca = row.class.toLowerCase().match(this.search.toLowerCase());
				}
				return ( na || sp || transp || ca );
			});
		},

	},
	methods: {
		sortBy(key) {
			if (key == this.sortKey) {
				this.sortOrder = (this.sortOrder == 'asc') ? 'desc' : 'asc';
			} else {
				this.sortKey = key;
				this.sortOrder = 'asc';
			}
			this.getSortedRes();
    	},
		getSortedRes() {
			let url = 'http://206.81.18.153/api/mylapsdata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			if(window.location.host == 'localhost') {
				url = 'http://localhost/pwww/Race/public/api/mylapsdata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			}
			axios.get(url)
				.then(response =>
					this.res = response.data
				);
		},
		url(id, action) {
			let hrefurl = '';
			if(window.location.host == 'localhost') {
				hrefurl = 'http://localhost/pwww/Race/public/mylaps/'+action+'/'+id;
			} else {
				hrefurl = 'http://206.81.18.153/mylaps/'+action+'/'+id;
			}
			return hrefurl;
		},
		teamurl(id) {
			let hrefurl = '';
			if(window.location.host == 'localhost') {
				hrefurl = 'http://localhost/pwww/Race/public/data/teamview/'+this.raceid+'?teamid='+id;
			} else {
				hrefurl = 'http://206.81.18.153/data/teamview/'+this.raceid+'?teamid='+id;
			}
			return hrefurl;
		}
  },
	mounted() {
			let patharray = window.location.pathname.split("/");
			this.raceid = patharray[patharray.length-1];


			let url = 'http://206.81.18.153/api/mylapsdata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			if(window.location.host == 'localhost') {
				url = 'http://localhost/pwww/Race/public/api/mylapsdata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			}
			axios.get(url)
				.then(response =>
					this.res = response.data
				);
		}
});

let hardcardapp = new Vue({
	el: '#hardcardtable',

	data: {
		search: '',
		raceid: '',
		sortKey: 'time',
		sortOrder: 'asc',
	    reverse: false,
	    columns: ['tagid', 'frequency', 'signalstrength', 'antenna', 'time', 'datetime', 'hits', 'competitorid', 'competitionnumber', 'firstname', 'lastname', 'lap_time', 'deleted'],
		res: []
	},
	computed: {
		filteredTracks(){
			return this.res.filter((row) => {
				let tagid = false;
				let fn = false;
				let na = false;
				let lt = false;
				if(row.tagid) {
					tagid = row.tagid.toString().match(this.search);
				}
				if(row.firstname) {
					fn = row.firstname.toLowerCase().toString().match(this.search.toLowerCase());
				}
				if(row.lastname) {
					ln = row.lastname.toLowerCase().toString().match(this.search.toLowerCase());
				}
				if(row.lap_time) {
					lt = row.lap_time.match(this.search);
				}
				return ( tagid || fn || ln || lt );
			});
		}
	},
	methods: {
		sortBy(key) {
			if (key == this.sortKey) {
				this.sortOrder = (this.sortOrder == 'asc') ? 'desc' : 'asc';
			} else {
				this.sortKey = key;
				this.sortOrder = 'asc';
			}
			this.getSortedRes();
    	},
		getSortedRes() {
			let url = 'http://206.81.18.153/api/hardcarddata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			if(window.location.host == 'localhost') {
				url = 'http://localhost/pwww/Race/public/api/hardcarddata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			}
			axios.get(url)
				.then(response =>
					this.res = response.data
				);
		},
		url(id, action) {
			let hrefurl = '';
			if(window.location.host == 'localhost') {
				hrefurl = 'http://localhost/pwww/Race/public/hardcard/'+action+'/'+id;
			} else {
				hrefurl = 'http://206.81.18.153/hardcard/'+action+'/'+id;
			}
			return hrefurl;
		}
  },
	mounted() {
			let patharray = window.location.pathname.split("/");
			this.raceid = patharray[patharray.length-1];


			let url = 'http://206.81.18.153/api/hardcarddata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			if(window.location.host == 'localhost') {
				url = 'http://localhost/pwww/Race/public/api/hardcarddata?sortkey='+this.sortKey+'&sortorder='+this.sortOrder+'&raceid='+this.raceid;
			}
			axios.get(url)
				.then(response =>
					this.res = response.data
				);
		}
});

let newraceformapp = new Vue(({
	el: '#newraceform',
	data: {
			placeInput: '',
			dateInput: ''
		},
	computed: {
		inputClass() {
			return {
				notdone: this.placeInput.length == 0
			}
		},
		dateClass() {
			return {
				notdone: this.dateInput.length == 0
			}
		}
	}

}));

let loginformapp = new Vue(({
	el: '#loginform',
	data: {
			emailInput: '',
			passwordInput: ''
		},
	computed: {
		emailClass() {
			return {
				notdone: !this.emailInput.includes("@")
			}
		},
		passwordClass() {
			return {
				notdone: this.passwordInput.length == 0
			}
		}
	}

}));
