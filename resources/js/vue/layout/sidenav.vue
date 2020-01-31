<template>
  <div class="sidenav col-md-3 p-0 overflow-auto" style="position:fixed;z-index:99999">
    <div class="w-100 bg-green-header header-height-15"></div>
    <div class="bg-greend-sub-header w-100 px-3 event-header">
      <div class="row align-items-center">
        <div class="col text-center">
          <icon icon="calendar-week" />UPCOMING EVENTS
        </div>
      </div>
    </div>
    <div class="event center m-3">
      <div class="card mb-3" v-for="(event,index) in events" :key="index">
        <div class="additional">
          <div class="user-card">
            <div class="calendar date">
              <span class="binds"></span>
              <span class="month">{{event.eventStart | FormatMonth}}</span>
              <h1 class="day">{{event.eventStart | FormatDate}}</h1>
            </div>
          </div>

          <div class="more-info">
            <h5 class="text-white p-2">{{ event.events.toUpperCase() }}</h5>
            <hr />
            <p class="text-white p-2">{{ event.except }}</p>
          </div>
        </div>

        <div class="general">
          <h5 class="mt-2">{{ event.events.toUpperCase() }}</h5>
          <hr />
          <p>{{ event.description }}</p>
          <span class="more">
            <icon icon="users" />
            {{ event.department }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      events: [],
      month: ""
    };
  },

  methods: {
    getAllEvents: function() {
      this.$http.get("/events/list").then(data => {
        this.events = data.data;
      });
    }
  },

  mounted() {
    this.getAllEvents();
  }
};
</script>