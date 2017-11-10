<template>
    <div class="list-component">
        <div clas="row">
            <div class="col-md-12">
                <input type="text" class="form-control" v-model="search">
            </div>
        </div>
        <div clas="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ilmoitettu</th>
                            <th>Yritys</th>
                            <th>Kuvaus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="j in filterJobs(jobs)">
                            <td>{{ parseDate(j.created_at) }}</td>
                            <td>{{ j.company }}</td>
                            <td>{{ j.description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
module.exports = {
    props: ['in-jobs'],
	data: function() {
		return {
            jobs: [],
            search: ""
		}
	},
	methods: {
        parseDate(date) {
            return moment(date).format('DD.MM.YYYY');
        },
        filterJobs() {
            var me = this;
            var filteredJobs = [];
            
            if(this.jobs.length == 0) return false;
            
            if(this.search.length < 2) return this.jobs;
            
            this.jobs.forEach(function(job) {
				if(     job.company.toLowerCase().indexOf(me.search.toLowerCase()) != -1
                    ||  job.description.toLowerCase().indexOf(me.search.toLowerCase()) != -1) {
					filteredJobs.push(job);
                }
            });
   
            return filteredJobs;
        },
        fetchJobs() {
            var me = this;
            axios.get("http://localhost/jobz/jobz/public/jobs")
            .then(function (response) {
                me.jobs = response.data;
            }).catch(function (error) {
                alertify.error(error);
            });
        }
	},
	created: function() {
        if(this.inJobs && this.inJobs.length > 0) {
            this.jobs = this.inJobs;
        } else {
            this.fetchJobs();
        }
	}
}
</script>

<style scoped>
    .list-component {
        margin-top: 20px;
    }
</style>