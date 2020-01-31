<template>
  <div class="col-md-9 main-body">
    <div class="container-fluid mt-3 main-div">
      <div v-if="showtabular">
        <CustomTable :data="dtData">
          <template slot="action" slot-scope="props">
            <div class="container-fluid">
              <div class="row">
                <a href="#" class="alert-link text-green text-center w-100">View Citizen Charter</a>
              </div>
              <hr />
              <div class="row" style="font-size:9px;">
                <div class="col-4">
                  <label>1. Request for Capability building/Technical assistance</label>
                </div>
                <div class="col-4">
                  <label>2. Recognizing Youth Excellence Implementation based on approved Provincial Ordinance 01-2008 (EVERY 3 YEARS)</label>
                </div>
                <div class="col-4">
                  <label>3. Conduct sports clinic</label>
                </div>
                <div class="col-4">
                  <label>4. Provision of Cash incentives to bemedalled athletes</label>
                </div>
                <div class="col-4">
                  <label>5. Conduct Sports Competition</label>
                </div>
                <div class="col-4">
                  <label>6. Provision of financial assistance to sports related activities & provision of sports supplies, material and equipments including fabricated basketball boards</label>
                </div>
              </div>
            </div>
          </template>
        </CustomTable>
      </div>

      <div v-if="!showtabular">
        <div class="row">
          <div
            class="col-md-3 d-flex align-items-stretch"
            v-for="(department,index) in dtData.data"
            :key="index"
          >
            <blockquote class="department-blockquote w-100 text-center">
              <router-link
                :to="{name:'Charter', params:{id: department.id,code:null}}"
                class="text-green"
              >{{ department.department }}</router-link>
            </blockquote>
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
      showtabular: false,
      dtData: {
        data: [],
        header: ["Department", "Department Nick", "Charter"],
        key: ["department", "department_nick", "action"],
        th_size: ["5%", "1%", "10%"],
        position: {
          center: [1]
        }
      }
    };
  },

  methods: {
    getAllDepartments: function() {
      this.$http.get("/department/list").then(data => {
        this.dtData.data = data.data;
      });
    }
  },

  mounted() {
    this.getAllDepartments();
  }
};
</script>