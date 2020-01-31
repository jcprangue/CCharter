<template>
  <div class="col-md-9 main-body">
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-md-4">
          <select class="form-control rounded-pill m-0 border border-success" v-model="searchText">
            <option value selected disabled>--Select Service Name--</option>
            <option
              v-for="(list,index) in autocomplete"
              :key="index"
              :value="list.service_name"
            >{{list.service_name}}</option>
          </select>
        </div>
      </div>
      <CustomTable :data="dtData" :search_input="false">
        <template slot="requirements" slot-scope="props">
          <div>{{props.row.requirements}}</div>
        </template>
      </CustomTable>
    </div>
  </div>
</template>
<script>
export default {
  props: ["id", "code"],
  data() {
    return {
      dtData: {
        data: [],
        header: [
          "Service Name",
          "Steps",
          "Requirement",
          "Forms Used",
          "Processing Time",
          "Service Provider"
        ],
        key: [
          "service_name",
          "steps",
          "requirements",
          "forms_used",
          "processing_time",
          "service_provider"
        ],
        th_size: ["15%", "25%", "20%", "10%", "10%", "10%"],
        position: {
          center: [4]
        }
      },

      office: [],
      autocomplete: [],
      searchText: ""
    };
  },
  watch: {
    code: function(val) {
      this.$http
        .post("/charter/find/", { id: this.id, service_code: val })
        .then(data => {
          this.dtData.data = data.data;
        });
    },
    searchText: function(val) {
      var vm = this;
      vm.$http
        .post("/search/service", { id: vm.id, search: val })
        .then(data => {
          vm.dtData.data = data.data;
        });
    }
  },
  methods: {
    getdeptData: function() {
      this.$http
        .post("/charter/find/", { id: this.id, service_code: this.code })
        .then(data => {
          this.dtData.data = data.data;
          this.searchText = data.data[0].service_name;
        });
    },

    getOfficeInfor: function() {
      var vm = this;
      vm.$http.get("/office/" + vm.id).then(data => {
        vm.office = data.data;
        vm.$store.commit("setActiveOffice", data.data);
      });
    },

    getautocomplete: function() {
      var vm = this;
      vm.$http.get("/search/dept/" + vm.id).then(data => {
        vm.autocomplete = data.data;
      });
    }
  },

  destroyed() {
    this.$store.commit("setActiveOffice", null);
  },

  mounted() {
    this.getdeptData();
    this.getOfficeInfor();
    this.getautocomplete();
  }
};
</script>