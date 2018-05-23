<template>
  <div class="app-container">
    <!-- upload excel files here -->
    <upload-excel-component @on-selected-file='selected'></upload-excel-component>

    <!-- display form -->
    <el-form ref="resultsForm" :model="resultsForm" :rules="resultsRules" status-icon>
      <el-col :span="7">
        <el-form-item label="Term" prop="term">
          <el-select v-model="resultsForm.term" placeholder="Please results term" size="medium">
            <el-option v-for="term in 3" :key="term" :value="term">Term {{term}}</el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="User Level" prop="cls">
          <el-select v-model="resultsForm.cls" placeholder="Select Class" size="medium">
            <el-option label="Admin" value="admin"></el-option>
            <el-option label="Head Master" value="head"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Class Teacher" prop="teacher">
          <el-select v-model="resultsForm.teacher" placeholder="Pick class Teacher" size="medium">
            <el-option label="Admin" value="admin"></el-option>
            <el-option label="Head Master" value="head"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
    </el-form>

    <!-- button to upload results -->
    <el-button @click="getData(tableData)" type="primary" circle id="fab-upload">
      <i class="el-icon-upload2"></i>
    </el-button>

    <!-- display data on this table -->
    <el-table :data="tableData" border highlight-current-row style="width: 100%;margin-top:20px;">
      <el-table-column v-for='item of tableHeader' :prop="item" :label="item" :key='item'>
      </el-table-column>
    </el-table>

    <div class="block">
      <el-pagination
        layout="prev, pager, next"
        :total="tableData.length">
      </el-pagination>
    </div>
  </div>
</template>

<script>
import { saveUpload } from '../../../api/results'
import UploadExcelComponent from '../../../components/UploadResults/index.vue'

export default {
  name: 'ResultsUploadComponent',
  components: { UploadExcelComponent },
  data() {
    return {
      tableData: [],
      tableHeader: []
    }
  },
  methods: {
    openSucess() {
      this.$message({
        message: 'Successfuly Uploaded the results',
        type: 'success'
      })
    },
    openError(object) {
      this.$message({
        message: `Oops! Something went wrong while uploading! ${object}`,
        type: 'error'
      })
    },
    selected(data) {
      this.tableData = data.results
      this.tableHeader = data.header
    },
    getData(dataResults) {
      // count to track when finished
      let count = 0

      // loop the excel data
      dataResults.forEach(row => {
        // post results to the api
        saveUpload(row)
          .then(res => {
            count++ // increment by one on every loop

            // check if upload is finished
            if(count === dataResults.length){
              // uloaded successuly
              this.openSucess()

              // empty the table
              this.tableData = []
              this.tableHeader = []

              // TODO: navigate to list of reults
            }
          })
          .catch(err => {
            // error while uloading
            this.openError('results')
          })
      })
    }
  }
}
</script>

<style>
  #fab-upload {
    float: right;
  }
</style>
