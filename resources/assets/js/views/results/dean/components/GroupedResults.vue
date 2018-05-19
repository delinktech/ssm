<template>
  <div>
    <el-col :span="7" v-for="o in 40" :key="o" :offset="offset" class="my-card">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span style="line-height: 21px;">Class 5 West</span>
        </div>

        <div>
          <p>5 W</p>
        </div>

        <div>
          <div class="bottom clearfix">
            <time class="time">{{ currentDate }}</time>

            <!-- call component to show popover -->
            <notify-popover></notify-popover>

          </div>
        </div>

      </el-card>
    </el-col>
  </div>
</template>

<script>
  import moment from 'moment'
  import NotifyPopover from './NotifyPopover'

  export default {
    name: 'GroupedResults',
    components: {
      NotifyPopover
    },
    data() {
      return {
        offset: 1,
        currentDate: moment(new Date()).format('dddd MMM DD-YYYY')
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
</style>
