<style>
	.page-link{
		cursor: pointer;
	}
</style>
<template>
	<nav aria-label="Page navigation example">
	  <ul class="pagination justify-content-end">
	    <li class="page-item disabled" v-if="active == 0">
	      <a class="page-link"  tabindex="-1" @click="previous()">Previous</a>
	    </li>
	    <li class="page-item" v-else>
	      <a class="page-link"  tabindex="-1" @click="previous()">Previous</a>
	    </li>
		<template v-for="key in paginate_number">
			<template v-if="data.length >= key">
				<li class="page-item active" v-if="key == active">
					<a class="page-link"  @click="move(key)">{{key + 1}}</a>
				</li>
				<li class="page-item" v-else>
					<a class="page-link"  @click="move(key)">{{key + 1}}</a>
				</li>
			</template>
		</template>
	    <li class="page-item disabled" v-if="active == data.length - 1">
	      <a class="page-link"  @click="next()">Next</a>
	    </li>

	     <li class="page-item" v-else>
	      <a class="page-link"  @click="next()">Next</a>
	    </li>
	  </ul>
	</nav>
</template>
<script>
	export default{
		props: ["data", "active"],
		computed: {
			paginate_number: function(){
				var data = typeof this.data === undefined ? [] : this.data;
				var index = this.active <= 2 ? 0: this.active - 2;
				var position = this.active <= 2 ? 5 : this.active +3;
				return data.slice(index, position);
			}
		},
		methods: {
			previous: function(){
				this.$emit('paginateChange', this.active - 1);
			},
			next: function(){
				this.$emit('paginateChange', this.active + 1);
			},
			move: function(index)
			{
				this.$emit('paginateChange', index);
			}
		}
	}
</script>