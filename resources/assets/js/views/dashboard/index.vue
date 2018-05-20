<template>
  <div class="dashboard-container">

    <div class='my-card-panel clearfix'>
      <div class="my-card-panel-desc">
        <div class="my-card-panel-sch">{{school.school_name}}</div>
        <div class="my-card-panel-user">Username: {{name}} as: {{roles}}</div>
      </div>
    </div>

    <!-- call component to dislay school info -->
    <school-info :school="school" :teachers="teachers" :classes="classes" :students="students" :users="users"></school-info>

    <!-- <el-row style="background:#fff;padding:16px 16px 0;margin-bottom:32px;">
      <line-chart :chart-data="lineChartData"></line-chart>
    </el-row> -->

  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import SchoolInfo from './components/SchoolInfo'
import LineChart from './components/LineChart'

const lineChartData = {
  newVisitis: {
    expectedData: [100, 120, 161, 134, 105, 160, 165],
    actualData: [120, 82, 91, 154, 162, 140, 145]
  },
  messages: {
    expectedData: [200, 192, 120, 144, 160, 130, 140],
    actualData: [180, 160, 151, 106, 145, 150, 130]
  },
  purchases: {
    expectedData: [80, 100, 121, 104, 105, 90, 100],
    actualData: [120, 90, 100, 138, 142, 130, 130]
  },
  shoppings: {
    expectedData: [130, 140, 141, 142, 145, 150, 160],
    actualData: [120, 82, 91, 154, 162, 140, 130]
  }
}

export default {
  name: 'dashboard',
  components: {
    SchoolInfo,
    LineChart
  },
  data() {
    return {
      lineChartData: lineChartData.newVisitis
    }
  },
  computed: {
    ...mapGetters([
      'name',
      'roles',
      'school',
      'teachers',
      'classes',
      'students',
      'users'
    ])
  },
  methods: {
    handleSetLineChartData(type) {
      this.lineChartData = lineChartData[type]
    }
  }
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.dashboard {
  &-container {
    margin: 30px;
  }
  &-text {
    font-size: 30px;
    line-height: 46px;
  }
}
.clearfix:before,
.clearfix:after {
  display: table;
  content: "";
}
.clearfix:after {
  clear: both
}
.my-card-panel {
  height: 108px;
  font-size: 12px;
  overflow: hidden;
  color: #666;
  background: #fff;
  box-shadow: 4px 4px 40px rgba(0, 0, 0, .05);
  border-color: rgba(0, 0, 0, .05);
}
.my-card-panel-desc {
  font-weight: bold;
  margin: 26px;
  margin-left: 0px;
  text-align: center;
  .my-card-panel-user {
    font-size: 14px;
    line-height: 18px;
    margin-bottom: 12px;
    color: rgba(0, 0, 0, 0.45);
  }
  .my-card-panel-sch {
    font-size: 20px;
    margin-bottom: 12px;
  }
}
</style>
