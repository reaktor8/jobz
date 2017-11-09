	var vm = new Vue({
		el: '#job-app',
		components: { 
			'job-list': httpVueLoader('/js/views/job-list.vue?ts=' + moment().format('DDMMYYYYHH')),
		},
		data: {},
		created() {
            console.log('nope, not working');
        },
		methods: {}
	});