<template>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <h1>Job displaying challenge</h1>
        </div>
      </div>
    </nav>
</template>

<script>
module.exports = {
	data: function() {
		return {
		}
	},
	methods: {
	},
	created: function() {
        console.log('Initializing header');
	}
}
</script>

<style scoped>
    .navbar {
        color: white;
        background: rgba(48, 176, 251, 1);
        margin-bottom: 20px;
    }
</style>