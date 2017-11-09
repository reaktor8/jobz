<template>
    <div>
        <job-synchronizer></job-synchronizer>
        <job-list></job-list>
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
		}
	},
	methods: {
	},
	created: function() {
        alertify.success('Initializing manager');
	}
}
</script>

<style>
</style>