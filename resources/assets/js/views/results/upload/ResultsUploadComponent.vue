<template>
  <div class="app-container">
    <!-- upload excel files here -->
    <upload-excel-component @on-selected-file='selected'></upload-excel-component>

    <md-button @click="getData(tableData)" class="md-fab md-fab-bottom-right md-primary" id="fab-upload">
      <md-icon>file_upload</md-icon>
    </md-button>
    <!-- display data on this table -->
    <el-table :data="tableData" border highlight-current-row style="width: 100%;margin-top:20px;">
      <el-table-column v-for='item of tableHeader' :prop="item" :label="item" :key='item'>
      </el-table-column>
    </el-table>
    
  </div>
</template>

<script>
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
    selected(data) {
      this.tableData = data.results
      this.tableHeader = data.header
    },
    getData(data) {
      console.log('data', data.length)
    }
  }
}
</script>
