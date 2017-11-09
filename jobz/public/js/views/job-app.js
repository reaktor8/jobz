	var vm = new Vue({
		el: '#job-app',
		components: { 
			'job-app-header': httpVueLoader(globals.assetRoot + '/job/job-app-header.vue?ts=' + moment().format('DDMMYYYYHH')),
			'job-manager': httpVueLoader(globals.assetRoot + '/job/job-manager.vue?ts=' + moment().format('DDMMYYYYHH')),
		},
		data: {},
		created() {
        },
		methods: {}
	});