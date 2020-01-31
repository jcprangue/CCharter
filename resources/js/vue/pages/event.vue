<template>
     <div class="col-md-9">
         
        <div class="container-fluid mt-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#eventmodal">ADD</button>
            
            <div class="modal fade" id="eventmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallable">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputevent">Event Name</label>
                        <input type="text" class="form-control" id="event" placeholder="Enter event" v-model="forms.events">
                    </div>
                    <div class="form-group">
                        <label for="selectdepartment">Select Department</label>
                        <select name="department" id="department" class="form-control" v-model="forms.departments">
                            <option value="" SELECTED DISABLED>--Select Department--</option>
                            <option v-for="(department,index) in dept" :key="index" :value="department.id">{{ department.department }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputdesc">Description</label>
                        <textarea name="descripton" id="description" rows="5" class="form-control" v-model="forms.description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputstart">Date Start</label>
                        <input type="date" class="form-control" id="datestart" placeholder="Date Start" v-model="forms.eventStart">
                    </div>

                    <div class="form-group">
                        <label for="inputend">Date End</label>
                        <input type="date" class="form-control" id="dateend" placeholder="Date End" v-model="forms.eventEnd">
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="savedata()">Save changes</button>
                </div>
                </div>
            </div>
            </div>

            <CustomTable :data="dtData" tableClass="table">
                <template slot="Action" slot-scope="props" >
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" @click="getData(props)">Edit</button>
                        <button type="button" class="btn btn-danger" @click="deletedata(props)">Delete</button>
                    </div>
                </template>
            </CustomTable>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            method:'ADD',
            dept:[],
            dtData: {
                data: [],
                header: ["Events", "Department", "Description","Date Start", "Date End","Action"],
                key: ["events","department","description","event_start","event_end","Action"],
                th_size: [
                    "15%",
                    "10%",
                    "20%",
                    "15%",
                    "15%"
                ],
            
            },

            forms:{
                id:'',
                events:'',
                departments:'',
                description:'',
                eventStart:'',
                eventEnd:''
            }

        }
    },
    watch: {
      
    },

    methods: {
        getallEvents:function(){
            this.$http.get("/events/all").then(data =>{
                this.dtData.data = data.data;
            });
        },

        changesearch:function(id){
            this.$http.get("/search/dept/"+id).then(data =>{
                this.dtData.data = data.data;
            });
        },

        deletedata:function(row){
            console.log(row.row.id)
             this.$http.get("/delete/event/"+row.row.id).then(data =>{
                this.getallEvents()
                alert('Successfully Deleted')
            });
        },

        getAllDepartments:function(){
            this.$http.get("/department/list").then(data =>{
                this.dept = data.data;
            });
        },

        savedata:function(){
            if (this.method == "ADD"){
                this.$http.post("/event/save",this.forms).then(data =>{
                    this.getallEvents();
                    
                });
            }else{
                 this.$http.put("/event/"+this.forms.id, this.forms).then(data =>{
                    this.getallEvents();
                    this.method = "ADD";
                });
            }

            this.forms={
                        events:'',
                        departments:'',
                        description:'',
                        eventStart:'',
                        eventEnd:''
                    }
            
            $("#eventmodal").modal('hide');
        },

        getData:function(row){
            
            $("#eventmodal").modal('show');
            this.method = "EDIT";
            this.forms = row.row;
            console.log(this.forms)
        }

       
    },

    mounted() {
       this.getallEvents();
       this.getAllDepartments();
    },

}
</script>