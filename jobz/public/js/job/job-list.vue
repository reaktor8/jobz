<template>
    <div class="list-component">
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control" v-model="search" placeholder="Hae ilmoituksista...">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th @click="sortBy('created_at')">Ilmoitettu</th>
                            <th @click="sortBy('company')">Yritys</th>
                            <th @click="sortBy('description')">Kuvaus</th>
                        </tr>
                    </thead>
                    <tbody v-if="jobs.length > 0">
                        <tr v-for="j in filterJobs(jobs)">
                            <td>{{ parseDate(j.created_at) }}</td>
                            <td>{{ j.company }}</td>
                            <td><span v-html="renderDescription(j)"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3"><button class="btn btn-success form-control show-more" @click="config.limit += 10">Näytä lisää</button></td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="3" class="text-center">
                                <span v-if="savePending">
                                    Hetkinen... tietoja tallennetaan...
                                </span>
                                <span v-else>
                                    Tietokanta ei palauttanut rivejä... kokeile synkronointia?
                                </span>
                            </td>
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
            search: "",
            savePending: false,
            config: {
                limit: 10,
                sortBy: {
                    field: false,
                    direction: false
                }
            }
		}
	},
	methods: {
        parseDate(date) {
            return moment(date).format('DD.MM.YYYY');
        },
        setSavePending() {
            this.savePending = true;
        },
        toggleDetails(job) {
            job.displayDetails != job.displayDetails;
        },
        renderDescription(job) {
            var html = job.description;
            html = html.replace(/\r\n-/g,'<br/><br/>&#9679;');
            html = html.replace(/\r\n/,'<br/><br/>');
            return html; 
        },
        setJobs(jobs) {
            this.jobs = jobs;
        },
        filterJobs() {
            var me = this;
            
            var applyTextSearch = function(jobs) {
                var filteredJobs = [];
                jobs.forEach(function(job) {
                    if(     job.company.toLowerCase().indexOf(me.search.toLowerCase()) != -1
                        ||  job.description.toLowerCase().indexOf(me.search.toLowerCase()) != -1) {
                        filteredJobs.push(job);
                    }
                });
                return filteredJobs;
            }
            
            if(this.jobs.length == 0) return false;
            
            var filteredJobs = this.jobs;
            if(this.search.length >= 2) {
                filteredJobs = applyTextSearch(this.jobs);
            } 
            
            filteredJobs = filteredJobs.slice(0, this.config.limit);
            return filteredJobs;
        },
        sortBy(field) {
            var direction = this.config.sortBy.direction;
            
            this.config.sortBy = {
                field: field,
                direction: direction ? !direction : "asc"
            }
            
            this.fetchJobs(this.config)
        },
        fetchJobs(config) {
            var me = this;
            this.config.limit = 10;
            
            var params = "";
            if(config && config.sortBy.field) {
                params += "field=" + config.sortBy.field + "&";
                params += "direction=" + config.sortBy.direction + "&";
            }
            
            axios.get("http://localhost/jobz/jobz/public/jobs?" + params)
            .then(function (response) {
                var jobs = response.data;
                jobs.forEach(function(j) {
                    j.displayDetails = false;
                });
                me.jobs = jobs;
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
    .list-component table {
        margin-top: 20px;
    }
    .list-component th {
        background: rgb(48, 176, 251);
        color: white;
        cursor: pointer;
    }
    .list-component th:hover {
        background: rgb(28, 156, 231);
    }
    .show-more {
        padding: 25px;
    }
</style>