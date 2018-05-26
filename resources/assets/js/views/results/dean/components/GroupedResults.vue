<template>
  <div>
    <h3>{{heading}}</h3>
    <el-col v-if="!selectedYear" :span="7" v-for="(year, indx) in results" :key="indx" :offset="offset" class="my-card">
      <div  v-on:click="navigateTo(indx, year)">
        <el-card class="box-card">
          <!-- {{year}} -->
          <p style="line-height: 21px; text-align: center; color: #666; font-size: 24px;">{{indx}}</p>
        </el-card>
      </div>
    </el-col>

    <div v-if="selectedYear && selectedYearData" class="clearfix">
      <p>
        <el-button @click="goBack"><i class="el-icon-arrow-left el-icon-left"></i> Back</el-button>
      </p>
      <el-col :span="7" v-for="(cls, indx) in selectedYearData" :key="indx" :offset="offset" class="my-card">
        <div>
          <el-card class="box-card">
            <div slot="header" class="clearfix">
              <span style="line-height: 21px;">{{cls[0].classInfo.name}}</span>
            </div>
            <div>
              <!-- <p>{{cls[indx].classInfo.code}}</p> -->
              Last Edit: <time class="time">{{ currentDate }}</time>
            </div>

            <div class="bottom clearfix">
              <!-- call component to display results modal -->
              <results-modal :cls="cls" class="footer-icons"></results-modal>

              <!-- call component to show popover -->
              <notify-popover :cls="cls" class="footer-icons"></notify-popover>

            </div>

          </el-card>
        </div>
      </el-col>
    </div>

  </div>
</template>

<script>
  import moment from 'moment'
  import { mapGetters } from 'vuex'
  import ResultsModal from './ResultsModal'
  import NotifyPopover from './NotifyPopover'

  export default {
    name: 'GroupedResults',
    props: ['results'],
    components: {
      NotifyPopover,
      ResultsModal
    },
    data() {
      return {
        offset: 1,
        heading: null,
        yearSelected: null,
        selectedYear: false,
        selectedYearData: null,
        currentDate: moment(new Date()).format('dddd MMM DD-YYYY'),

      };
    },
    created() {
      this.heading = !this.selectedYear ? 'All classes Results' : `All Results for ${this.yearSelected}`
    },
    computed: {
      ...mapGetters([
        'teachers',
        'classes'
      ])
    },
    methods: {
      navigateTo(year, yearData) {
        this.selectedYear = true
        this.yearSelected = year
        this.selectedYearData = yearData
      },
      goBack(year=null, yearData=null) {
        this.selectedYear = false
        this.yearSelected = year
        this.selectedYearData = yearData
      }
    }
  }
</script>

<style scoped>
  .my-card {
    cursor: pointer;
    min-height: 100px;
    margin-bottom: 4%;
  }
  .time {
    font-size: 13px;
    color: #999;
  }
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }
  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }
  .clearfix:after {
    clear: both
  }
  .footer-icons {
    display: inline-block;
  }
</style>
