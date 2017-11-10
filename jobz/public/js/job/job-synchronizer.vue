<template>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success" @click="fetchJobs()">Synkronoi TE-palvelun ilmoitukset tietokantaan</button>
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
        setJobs(jobs) {
            this.jobs = jobs;
        },
        saveJobsToDB() {
            var me = this;
            alertify.success('... tallennetaan tulokset tietokantaan...');

            me.$emit('mark-save-pending', true);
            
            axios.post("http://localhost/jobz/jobz/public/jobs", {
                jobs: me.jobs
            })
            .then(function (response) {
                alertify.success('... ja valmista tuli!');
                me.$emit('mark-save-pending', false);
                me.$emit('refresh', response.data);
            })
            .catch(function (error) {
                alertify.error(error);
            });
        },
	},
	created: function() {
	}
}
</script>

<style>
</style>