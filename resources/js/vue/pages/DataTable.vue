<style>
	th.sortable{
		cursor: pointer;
	}
</style>
<template>
	<div>
		<div class="row justify-content-between">
			<slot name="top-right">
				<div class="col-md">
				</div>
			</slot>
			<div class="col-md-5" v-if="isSearch">
				<div class="row align-items-center">
					<div class="col-md-auto">
						<p class="m-0 p-0">Search: </p>
					</div>
					<div class="col-md">
						<input type="text" class="form-control form-control-sm" v-model="searchString" placeholder="Search . . . ">
					</div>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table  :class="table_class" class="mt-1">
				<thead :class="headerClass">
					<tr>
						<template v-for="(header, index) in _header">
							<template v-if="header.sortable">
								<th :width="typeof thSize[index] === 'undefined' ? 'auto' : thSize[index]" class="text-center text-uppercase sortable  align-middle" v-bind:key="header.key" @click="toggleSort(header.key)">{{header.name}}</th>
							</template>
							<template v-if="!header.sortable">
								<th :width="typeof thSize[index] === 'undefined' ? 'auto' : thSize[index]" class="text-center text-uppercase  align-middle" v-bind:key="header.name">{{header.name}}</th>
							</template>
						</template>
					</tr>
				</thead>
				<tbody>
					<template v-for="(data, index) in dtData">
						<tr v-bind:key="data[index]">
							<template v-for="(key, inKey) in dtKey">
								<template v-if="data[key]">
									<td :class="dataPositionClass(inKey)">
										<slot v-bind:row="data" :name="key">
											{{data[key]}}
										</slot>
									</td>
								</template>
								<template v-if="!data[key]">
									<td :class="dataPositionClass(inKey)">
										<slot v-bind:row="data" :name="key">
											{{data[key]}}
										</slot>
									</td>
								</template>
							</template>
						</tr>
					</template>
					<template v-if="filteredList.length <= 0 || dtData.length <= 0">
						<tr>
							<td class="text-center" :colspan="dtKey.length">No item found</td>
						</tr>
					</template>
				</tbody>
			</table>
		</div>
		<div class="row justify-content-between mt-2">
			<div class="col-auto">
				<div class="row">
					<div class="col-auto d-flex align-items-center">Show: </div>
					<div class="col">
						<select class="form-control form-control-sm" v-model="data_count">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col">
				<paginate :data="data_position_key" :active="data_position" @paginateChange="paginateChangeHandler"></paginate>
			</div>
		</div>
	</div>
</template>
<script>

	export default{
		props: ["data", "tableClass", "headerClass", "search_input"],
		data: function(){
			return {
				data_count: 100,
				data_position: 0,
				data_position_key: [],
				searchString: '',
				sortedKey: '',
			}
		},
		computed: {
			isSearch: function(){
				return typeof this.search_input === "undefined" || this.search_input == true ? true : false;
			},
			thSize: function(){
				return typeof this.data.th_size === "undefined" ? [] : this.data.th_size;
			},
			header_class: function(){
				return typeof this.headerClass === "undefined" ? "" : this.headerClass;
			},
			table_class: function(){
				return typeof this.tableClass === "undefined" ? "table bg-white table-bordered mt-2" : this.tableClass;
			},
			_header: function(){
				var data =  typeof this.data.header === "undefined" ? [] : this.data.header;
				var key =  typeof this.data.key === "undefined" ? [] : this.data.key;
				var sortable = typeof this.data.sortable === "undefined" ? [] : this.data.sortable;

				var array_list = [];
				for (var i = 0; i < data.length; i++) {
					
					var checksortable = sortable.includes(i) ? true : false;
					array_list.push({
						name: data[i],
						key: sortable.includes(i) ? key[i] : "NA",
						sortable : checksortable,
					});
				}
				return array_list;
			},
			filteredList: function(){
				var check_reverse = typeof this.data.reverse === "undefined" ? false : this.data.reverse;
				
				var data = this.data.data;
				var vm = this;

				this.data_position_key = [];
				this.data_position = 0;
				
				if(check_reverse)
				{
					return data.filter(function(item){
						return vm.arrFilter(Object.values(item), vm.searchString.toLowerCase());
					}).reverse()
				}else{
					return data.filter(function(item){
						return vm.arrFilter(Object.values(item), vm.searchString.toLowerCase());
					})
				}
			},
			dataPositionRight: function(){
				if(typeof this.data.position === "undefined")
				{
					return [];
				}else{
					var right = typeof this.data.position.right === "undefined" ? [] : this.data.position.right;
					return right;
				}
			},
			
			dataPositionCenter: function(){
				if(typeof this.data.position === "undefined")
				{
					return [];
				}else{
					var center = typeof this.data.position.center === "undefined" ? [] : this.data.position.center;
					return center;
				}
			},
			dtData: function(){
				var data = typeof this.filteredList === "undefined" ? [] : this.filteredList;
				var chunks = this.paginate_data(data);
				return chunks[this.data_position];
			},
			dtKey: function(){
				return typeof this.data.key === "undefined" ? [] : this.data.key;
			},
		},
		methods: {

			dataPositionClass: function(index)
			{
				var vm = this;
				var right = this.dataPositionRight;
				var center = this.dataPositionCenter;
				if(right.includes(index))
				{
					return "text-right";
				}else if(center.includes(index)){
					return "text-center";
				}
				else{
					return "";
				}
			},
			makeid: function(length) {
				var result           = '';
				var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				var charactersLength = characters.length;
				for ( var i = 0; i < length; i++ ) {
					result += characters.charAt(Math.floor(Math.random() * charactersLength));
				}
				return result;
			},
			toggleSort: function(array_key)
			{
				console.log(array_key);
				var vm = this;
				this.data.data.sort(function(a, b){

					var first = typeof a[array_key] === "string" ? a[array_key].toString().toUpperCase() : a[array_key];
					var second = typeof b[array_key] === "string" ? b[array_key].toString().toUpperCase() : b[array_key];

				if(vm.sortedKey == array_key)
				{
					if(first < second)
					{
						return 1;
					}

					if(first > second)
					{
						return -1;
					}
					return 0;
				}
				else
				{
					if(first < second)
					{
						return -1;
					}

					if(first > second)
					{
						return 1;
					}
					return 0;
				}
				});

				if(vm.sortedKey == array_key)
				{
					vm.sortedKey = "";
				}else{
					vm.sortedKey = array_key;
				}
			},

			paginateChangeHandler: function(val)
			{
				this.data_position = val;
			},

			paginate_data: function(data)
			{
				var chunks = [];
				var i = 0 
				var counter = 0;
				var key = [];
				this.data_count = typeof this.data_count === "string" ? parseInt(this.data_count) : this.data_count;

				while(i < data.length)
				{
					chunks.push(data.slice(i, i+= this.data_count));
					key.push(counter);
					counter++;
				}
				this.data_position_key = key;
				return chunks;
			},

			arrFilter: function(array, string){
				return array.map(function(array){
					return String(array).toLowerCase();
				}).find(function(array){
					return array.includes(string.toLowerCase());
				});
			},
		}
	}
</script>