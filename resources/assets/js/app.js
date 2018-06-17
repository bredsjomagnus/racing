
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

let app = new Vue({
	el: '#tablevue',

	data() {
	    return {
	        sortKey: ['name'],
	        sortOrder: ['asc'],
	    }
	},
	data: {
		search: '',
	    reverse: false,
	    columns: ['no', 'name', 'laps', 'lead', 'lap_time', 'speed', 'elapsed_time', 'passing_time', 'hits', 'strength', 'noice', 'photocell_time', 'transponder', 'backup_tx', 'backup_passing_time', 'class', 'deleted'],
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
				return (na || sp || transp || ca);
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
    },
  },
	mounted() {
		axios.get('http://localhost/pwww/Race/public/api/trackdata')
			.then(response =>
				this.res = response.data
			);
	}
});
