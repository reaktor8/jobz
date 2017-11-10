<template>
    <div>
        <div class="row">
            <button class="btn btn-success" @click="fetchJobs()">Fetch jobs from TE-Palvelut</button>
        </div>
    </div>
</template>

<script>
module.exports = {
	data: function() {
		return {
            jobs: []
		}
	},
	methods: {
        fetchJobs() {
            var me = this;
            axios.get("https://paikat.te-palvelut.fi/tpt-api/tyopaikat?englanti=true")
                .then(function (response) {
                    var jobs = response.data.response.docs;
                    
                    me.jobs = jobs;
                    alertify.success('Haku onnistui...');
                    me.saveJobsToDB();
                })
                .catch(function (error) {
                    alertify.error(error);
                });
        },
        saveJobsToDB() {
            var me = this;
            axios.post("http://localhost/jobz/jobz/public/jobs", {
                jobs: me.jobs
            })
            .then(function (response) {
                alertify.success('... tallennetaan tulokset tietokantaan...');
            })
            .catch(function (error) {
                alertify.error(error);
            });
        },
        updateJobs() {
            this.$emit('refresh-jobs',jobs);
        }
	},
	created: function() {
        console.log('Initializing list');
	}
}
</script>

<style>
</style>