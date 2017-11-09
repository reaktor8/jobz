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
		}
	},
	methods: {
        fetchJobs() {
            var me = this;
            axios.get("https://paikat.te-palvelut.fi/tpt-api/tyopaikat?englanti=true")
                .then(function (response) {
                    var results = response.data.response.docs;
                    alertify.success('Haku onnistui...');
                    me.saveJobsToDB();
                })
                .catch(function (error) {
                    alertify.error(error);
                });
        },
        saveJobsToDB() {
            axios.post("http://localhost/jobz/jobz/public/jobs")
            .then(function (response) {
                alertify.success('... tallennetaan tulokset tietokantaan...');
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
	},
	created: function() {
        console.log('Initializing list');
	}
}
</script>

<style>
</style>