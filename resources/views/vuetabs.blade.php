<div id='test-root'>
	<tabs>
		<tab name='about us' :selected='true'>
			<h1>Content of About Us</h1>
		</tab>
		<tab name='about you'>
			<h1>Content of About you</h1>
		</tab>
		<tab name='about mustard'>
			<h1>Content of About Mustard</h1>
		</tab>
	</tabs>


</div>

<script type="text/javascript">
Vue.component('tabs', {
	template: `	<div>
					<ul class="nav nav-pills">
						<li class='nav-item' v-for='tab in tabs'>
							<a class='nav-link' :class='{navactive : tab.isActive}' :href='tab.href' @click='selectTab(tab)'>{{ tab.name }}</a>
						</li>
					</ul>

					<div class='tab-details'>
						<slot></slot>
					</div>
				</div>
				`
				,
	data() {
		return {
			tabs: []
		}
	},
	mounted() {
		console.log(this.$children);
	},
	created() {
		this.tabs = this.$children;
	},
	methods: {
		selectTab(selectedTab) {
			this.tabs.forEach(tab => {
				tab.isActive = (tab.name == selectedTab.name)
			});
		}
	}
});

Vue.component('tab', {
	props: {
		name: {
			required: true
		},
		selected: {
			default: false
		}
	},
	template: `	<div v-show='isActive'>
					<slot></slot>
				</div>`,

	data() {
		return {
			isActive: false
		}

	},
	computed: {
		href() {
			return '#' + this.name.toLowerCase().replace(/ /g, '-');
		}
	},

	mounted() {
		this.isActive = this.selected
	}
});

var app = new Vue({
	el: '#test-root'
});

</script>
