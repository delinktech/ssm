<template>
  <div>
    <h3 v-if="!selectedYear">All School Results</h3> <h3 v-else>All {{yearSelected}} Results</h3>
    <el-col v-if="!selectedYear && !selectedTerm && !selectedClass" :span="7" v-for="(year, indx) in results" :key="indx" :offset="offset" class="my-card">
      <div  v-on:click="navigateTo('term', indx, year)">
        <el-card class="box-card">
          <p style="line-height: 21px; text-align: center; color: #666; font-size: 24px;">{{indx}}</p>
        </el-card>
      </div>
    </el-col>

    <!-- year selected -->
    <div v-if="selectedYear && selectedYearData" class="clearfix">
      <p>
        <el-button @click="goBack('year', null, null)"><i class="el-icon-arrow-left el-icon-left"></i> Back</el-button>
      </p>
      <el-col :span="7" v-for="(term, indx) in selectedYearData" :key="indx" :offset="offset" class="my-card">
        <div v-on:click="navigateTo('cls', indx, term)">
          <el-card class="box-card">
            <p style="line-height: 21px; text-align: center; color: #666; font-size: 24px;">Term {{indx}}</p>
          </el-card>
        </div>
      </el-col>
    </div>

    <!-- class term selected -->
    <div v-if="selectedTerm && selectedTermData" class="clearfix">
      <p>
        <el-button @click="goBack('term', selectedYear, selectedYearData)"><i class="el-icon-arrow-left el-icon-left"></i> Back</el-button>
      </p>
      <el-col :span="7" v-for="(cls, indx) in selectedTermData" :key="indx" :offset="offset" class="my-card">
        <div  v-on:click="navigateTo('exam', indx, cls)">
          <el-card class="box-card">
            <div slot="header" class="clearfix">
              <span style="line-height: 21px;">Class name</span>
            </div>
            <div>
              <!-- <p>{{cls[0].classInfo.code}}</p> -->
              <!-- Last Edit: <time class="time">{{ cls[0].updated_at | formatDate}}</time> -->
            </div>

          </el-card>
        </div>
      </el-col>
    </div>

    <div v-if="selectedClass && selectedClassData">
       <p>
        <el-button @click="goBack('term', selectedTerm, selectedTermData)"><i class="el-icon-arrow-left el-icon-left"></i> Back</el-button>
      </p>

      <el-col :span="7" v-for="(cls, indx) in selectedClassData" :key="indx" :offset="offset" class="my-card">
        <div>
          <el-card class="box-card">
            <div slot="header" class="clearfix">
              <span style="line-height: 21px;">Exam: {{indx}}</span>
            </div>
            <div>
              <p>{{cls[0].classInfo.code}}</p>
              Last Edit: <time class="time">{{ cls[0].updated_at | formatDate}}</time>
            </div>

            <div class="bottom clearfix">
              <!-- call component to display results modal -->
              <results-modal :cls="cls" class="footer-icons"></results-modal>

              <!-- call component to show popover -->
              <notify-popover :cls="cls" v-on:sending="sending=$event" class="footer-icons"></notify-popover>

              <!-- loader -->
              <span
                v-loading="sending"
                element-loading-text="Sending..."
                element-loading-spinner="el-icon-loading"
                style="float: right;position:relative;margin-right: 25%;margin-top: 10%;"></span>
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
        selectedTerm: null,
        classSelected: null,
        selectedTermData: null,
        sending: false,
        selectedClass: false,
        selectedClassData: null
      };
    },
    filters: {
      formatDate(value) {
        return moment(value).format('dddd MMM DD-YYYY')
      }
    },
    computed: {
      ...mapGetters([
        'teachers',
        'classes'
      ])
    },
    methods: {
      navigateTo(to, indx, data) {
        switch (to) {
          case 'term':
            this.selectedYear = true
            this.yearSelected = indx
            this.selectedYearData = data
            break;

          case 'cls':
            // hide term
            this.selectedYear = false

            this.selectedTerm = true
            this.classSelected = indx
            this.selectedTermData = data
            break;

          case 'exam':
            // hide
            this.selectedTerm = false

            this.selectedClass = true
            this.selectedClassData = data
            console.log('EXAM:', indx, ' DATA:', data);
          break;

          default:
            break;
        }

      },
      goBack(to, indx, data) {
        switch (to) {
          case 'term':
            this.selectedTerm = false
            this.selectedYear = true
            this.yearSelected = indx
            this.selectedYearData = data
            break;

          case 'year':
            this.selectedYear = false
            this.selectedTerm = false
            break;

          case 'term':
            this.selectedClass = false
            this.selectedTerm = true
            break;

          default:
            break;
        }
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
