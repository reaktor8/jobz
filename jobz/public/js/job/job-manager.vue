<template>
    <div>
        <job-synchronizer @refresh-jobs="refreshJobs"></job-synchronizer>
        <job-list :in-jobs="jobs"></job-list>
    </div>
</template>

<script>
module.exports = {
    components: { 
        'job-synchronizer': httpVueLoader(globals.assetRoot + '/job/job-synchronizer.vue?ts=' + moment().format('DDMMYYYYHHmmss')),
        'job-list': httpVueLoader(globals.assetRoot + '/job/job-list.vue?ts=' + moment().format('DDMMYYYYHHmmss')),
    },
	data: function() {
		return {
            jobs: []
		}
	},
	methods: {
        refreshJobs(jobs) {
            this.jobs = jobs;
        },
	},
	created: function() {
        alertify.success('Initializing manager');
	}
}
</script>

<style>
</style>