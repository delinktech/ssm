<template>
  <div class="app-container">
    <!-- upload excel files here -->
    <upload-excel-component @on-selected-file='selected'></upload-excel-component>

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
      dataResults.forEach(row => {
        // post results to the api
        saveUpload(row)
          .then(res => {
            // uloaded successuly
            this.openSucess()

            // TODO: navigate to list of reults

            // empty the table
            this.tableData = []
            this.tableHeader = []
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
