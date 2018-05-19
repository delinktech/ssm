<template>
  <div>

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
    components: {
      NotifyPopover,
      ResultsModal
    },
    data() {
      return {
        offset: 1,
        currentDate: moment(new Date()).format('dddd MMM DD-YYYY'),
        classes: [
          {
            name: 'Class 4 West',
            code: '4 W',
            teacher: 'Dancun Mwangi',
            results: [
              {
                date: '2016-05-02',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-04',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-01',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-03',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }
            ]
          },
          {
            name: 'Class 8 North',
            code: '8 N',
            teacher: 'Dancun Mwangi',
            results: [
              {
                date: '2016-05-02',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-04',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-01',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-03',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }
            ]
          },
          {
            name: 'Class 2 South',
            code: '2 S',
            teacher: 'Dancun Mwangi',
            results: [
              {
                date: '2016-05-02',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-04',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-01',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-03',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }
            ]
          },
          {
            name: 'Class 4 East',
            code: '4 E',
            teacher: 'Dancun Mwangi',
            results: [
              {
                date: '2016-05-02',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-04',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-01',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }, {
                date: '2016-05-03',
                name: 'John Smith',
                address: 'No.1518,  Jinshajiang Road, Putuo District'
              }
            ]
          },
          {
            name: 'Class 3 North',
            code: '3 N',
            teacher: 'Dancun Mwangi',
            results: [

            ]
          },
        ]
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
