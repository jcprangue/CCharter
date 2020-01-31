<template>
  <div class="col-md-9 main-body">
    <div class="container-fluid mt-3">
      <div class="row mt-4">
        <div class="col-md-3 border-right overflow-auto">
          <ul class="list-group list-group-flush" style="font-size:10px;">
            <li
              class="list-group-item"
              v-for="(department, index) in dept"
              :key="index"
              @click="changesearch(department.id)"
            >{{ department.department }}</li>
          </ul>
        </div>
        <div class="col-md-9">
          <!-- <div class="float-right text-green">
                        <label class="font-weight-bold">Search Found:10 Records</label><br>
          </div>-->

          <CustomTable :data="dtData" tableClass="table" :search_input="false">
            <template slot="service_name" slot-scope="props">
              <div class="searchResult">
                <h3 class="mb-4">
                  <router-link
                    class="text-green"
                    :to="{name:'Charter', params:{id: props['row']['dept'],code:props['row']['service_code'] }}"
                  >{{ props["row"]["service_name"] }}</router-link>
                </h3>
                <p>{{ props["row"]["steps"] }}</p>
              </div>
            </template>
          </CustomTable>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["textsearch", "searchResult"],
  data() {
    return {
      dept: [],
      dtData: {
        data: [],

        key: ["service_name"],
        th_size: ["100%"]
      }
    };
  },
  watch: {
    textsearch: function(val) {
      this.$http.get("/search/list/" + val).then(data => {
        this.dtData.data = data.data;
        console.log(this.dtData.data);
      });
    }
  },

  methods: {
    getAllDepartments: function() {
      this.$http.get("/department/list").then(data => {
        this.dept = data.data;
      });
    },

    changesearch: function(id) {
      this.$http.get("/search/dept/" + id).then(data => {
        this.dtData.data = data.data;
      });
    }
  },

  mounted() {
    this.getAllDepartments();
    this.dtData.data = this.searchResult;
    // this.dtData.header = ["RESULT FOUND: 1000"];
  }
};
</script>