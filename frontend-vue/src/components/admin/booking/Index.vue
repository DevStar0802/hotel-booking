<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>Booking Manager</h2>
        <div class="row my-2">
          <a href="#" :class="{'btn btn-primary btn-lg ': true,'active':calendarMode}" role="button" :aria-pressed="calendarMode" @click="calendarMode  = !calendarMode">Calendar Mode <span>{{calendarMode?'Off':'On'}}</span> </a>
        </div>
        <div class="row my-2" v-if="!calendarMode">
          <div class="col-sm-12 col-md-5 form-group">
            <label>Filter by date</label>
            <datepicker v-model="filterDate" :use-utc="true"></datepicker>
          </div>
          <div class="col-sm-12 col-md-5 pt-2">
            <button type="button" class="btn btn-success mt-3" @click="filterByDate" name="button">Filter</button>
          </div>
        </div>
        <div class="row" v-if="!calendarMode">
          <table class="table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Room ID</td>
                <td>Date Start</td>
                <td>Date End</td>
                <td>Customer ID</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="booking in bookings" :key="booking.id">
                <td>{{booking.id}}</td>
                <td>{{booking.room_id}}</td>
                <td>{{booking.start_date}}</td>
                <td>{{booking.end_date}}</td>
                <td>{{booking.customer_id}}</td>
                <td>
                  <router-link :to="{name: 'booking-edit', params:{id:booking.id}}" class="btn btn-info mx-2">Edit</router-link>
                  <button type="button" @click="removeItem(booking.id)" class="btn btn-danger mx-2">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row my-2" v-if="calendarMode">
          <div class="col-sm-12 col-md-4 form-group">
            <label>Year</label>
            <select class="form-control" v-model="selectedYear">
              <option v-for="year in yearsInSelect" :value="year">{{year}}</option>
            </select>
          </div>
          <div class="col-sm-12 col-md-4 form-group">
            <label>Month</label>
            <select class="form-control" v-model="selectedMonth">
              <option v-for="(month, index) in monthsYear" :value="index">{{month}}</option>
            </select>
          </div>
          <div class="col-sm-12 col-md-4 pt-2">
            <button type="button" class="btn btn-success mt-3" name="button" @click="pushCalendar">Show Calendar</button>
          </div>
        </div>
        <div class="row" v-if="calendarMode">
          <div class="container">
            <div class="row">
              <div class="col border">Sunday</div>
              <div class="col border">Monday</div>
              <div class="col border">Tuesday</div>
              <div class="col border">Wednesday</div>
              <div class="col border">Thursday</div>
              <div class="col border">Friday</div>
              <div class="col border">Saturday</div>
            </div>
            <div class="row" v-for="week in month.week">
              <div class="col border p-2" v-for="day in week.day" :class="day.link?'bg-success text-white':''">
                <span :class="day.today?'text-white bg-dark':''" >{{day.day>0?day.day:''}}</span><br><br>
                <span v-if="day.booking" v-for="bok in day.booking" class="cursor-pointer" @click="goToBooking(bok)">
                  Booking {{bok}}
                  <br>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {formatDate} from '@/helpers';
import Datepicker from 'vuejs-datepicker';
import {mapGetters, mapActions} from 'vuex'

export default {
  data(){
    return {
      calendarMode:false,
      selectedMonth:0,
      selectedYear:0,
      todayDate: new Date(),
      yearsInSelect:[],
      daysInWeek:['sunday','monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
      monthsYear:['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      month:[],
      firstDay: 0,
      filterDate:''

    }
  },
  methods:{
    ...mapActions(['fetchBookings', 'deleteBooking']),
    filterByDate(){
      this.fetchBookings({date : formatDate(this.filterDate)});
    },
    removeItem(id){
      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          this.deleteBooking(id);
        }
      })
    },
    daysInMonth(iMonth, iYear) {
        return 32 - new Date(iYear, iMonth, 32).getDate();
    },
    goToBooking(id){
      this.$router.push({name:'booking-edit', params:{id:id}});
    },
    showCalendar(month, year){
       this.firstDay = new Date(year, month, 1);
       let date = 1;
       this.month.week = [];
       for (let i = 0; i < 6; i++) {
         this.month.week.push({day:[]});
         for (let j = 0; j < 7; j++) {
            if (i === 0 && j < this.firstDay.getDay() || date > this.daysInMonth(month, year)) {
                this.month.week[i].day.push({day:0});
            }
            else {
                var objDate = {};

                if (date === this.todayDate.getDate() && year === this.todayDate.getFullYear() && month === this.todayDate.getMonth()) {
                    objDate['today'] = true;
                }
                var mdate = new Date(year, month, date);
                objDate['booking']= [];
                for(var m in this.bookings){

                  var startd = this.bookings[m].start_date.split('-');
                  startd = new Date(startd[0],startd[1]-1, startd[2]);
                  var endd = this.bookings[m].end_date.split('-');
                  endd = new Date(endd[0],endd[1]-1, endd[2]);

                  if(startd <= mdate && endd >= mdate){
                      objDate['link'] = true;
                      objDate['booking'].push(this.bookings[m].id);
                  }
                }

                objDate['day'] = date;
                this.month.week[i].day.push(objDate);
                date++;
            }
        }
        if (date > this.daysInMonth(month, year)) {
            break;
        }
      }
      this.month.push(0);
      this.month.pop();
    },
    pushCalendar(){
      this.fetchBookings({month:this.selectedMonth+1, year:this.selectedYear}).then(()=>{
        this.showCalendar(this.selectedMonth, this.selectedYear);
      });

    }
  },
  computed: mapGetters(['bookings']),
  created(){
    this.fetchBookings();
    let year = this.todayDate.getFullYear() -2;
    this.selectedYear = year;
    for (var i = year; i < (this.todayDate.getFullYear()+8); i++) {
      this.yearsInSelect.push(i);
    }
  },
  components: {
    datepicker: Datepicker
  },
}
</script>
<style  lang="css" scoped>
  .cursor-pointer{
    cursor:pointer;
  }
</style>
