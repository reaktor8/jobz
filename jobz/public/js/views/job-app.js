	var vm = new Vue({
		el: '#job-app',
		components: { 
			'job-list': httpVueLoader(globals.assetRoot + '/job/job-list.vue?ts=' + moment().format('DDMMYYYYHH')),
		},
		data: {},
		created() {
        },
		methods: {}
	});