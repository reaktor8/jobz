<template>
    <div>
        <job-synchronizer @refresh="refreshJobs" @mark-save-pending="markSavePending"></job-synchronizer>
        <job-list :in-jobs="jobs" ref="jobList"></job-list>
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
        markSavePending(boolPending) {
            this.$refs.jobList.setSavePending(boolPending);
        },
        refreshJobs(jobs) {
            this.$refs.jobList.setJobs(jobs);
        },
	},
	created: function() {
        alertify.success('Initializing manager');
	}
}
</script>

<style>
</style>