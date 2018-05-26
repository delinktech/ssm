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

    <el-col :span="7" v-for="cls in classes" :key="cls.code" :offset="offset" class="my-card">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span style="line-height: 21px;">{{cls.name}}</span>
        </div>

        <div>
          <p>{{cls.code}}</p>
          Last Edit: <time class="time">{{ currentDate }}</time>
        </div>

        <div class="bottom clearfix">
          <!-- call component to display results modal -->
          <results-modal :cls="cls" class="footer-icons"></results-modal>

          <!-- call component to show popover -->
          <notify-popover :cls="cls" class="footer-icons"></notify-popover>

        </div>

      </el-card>
    </el-col>
  </div>
</template>

<script>
  import moment from 'moment'
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
        currentDate: moment(new Date()).format('dddd MMM DD-YYYY'),

      };
    }
  }
</script>

<style scoped>
  .my-card {
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
