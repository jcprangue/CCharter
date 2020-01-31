<template>
    <div class="navigationbar">
        <div class="w-100 bg-green-header header-height-15"></div>
        <div class="bg-greend-sub-header w-100 px-3 py-2">
            <div class="row align-items-center">
                <div class="col-9 border-white">
                    <div class="float-left pt-1">
                        
                        <router-link class="text-white" :to="{name:'Main-Panel'}"><icon icon="home"></icon> Home</router-link> | 
                        <router-link class="text-white" :to="{name:'Main-Panel'}"> {{activeOffice != null ? activeOffice.department : "Provincial Governement Offices"}} Citizens Charter</router-link> 
                    </div>

                    <div class="float-right w-50">
                        <input type="text" class="form-control rounded-pill m-0" placeholder="Search in all department Citizen charter Here!!!" v-on:keyup.enter="onEnter" v-model="searchText">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>
<script>
export default {
    data() {
        return {
            searchText:'',
        }
    },
    computed: {
        activeOffice: function(){
            return this.$store.state.ACTIVE_OFFICE;
        }
    },

    methods: {
        onEnter: function() {
            this.$http.get("/search/list/"+this.searchText).then(data =>{
                this.$router.push({name:'Search-Result', params:{textsearch: this.searchText,searchResult:data.data}})
                this.searchText = "";
            });
        }
    },
    
}
</script>