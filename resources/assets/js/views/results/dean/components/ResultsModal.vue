<template>
  <div>
    <!-- click button to view results -->
    <el-tooltip content="View Results" placement="bottom">
      <el-button  @click="dialogTableVisible=true" type="text" size="small"><md-icon>view_list</md-icon></el-button>
    </el-tooltip>

    <!-- display rsults in a table -->
    <el-dialog :title="cls.name + ' Results'" :visible.sync="dialogTableVisible" width="80%">
      <el-table :data="cls">
        <el-table-column property="student" label="Student" width="150"></el-table-column>
        <el-table-column property="subject" label="Subject" width="200"></el-table-column>
        <el-table-column property="marks" label="Marks"></el-table-column>
        <el-table-column property="term" label="Term"></el-table-column>
      </el-table>
    </el-dialog>
  </div>
</template>

<script>
  export default {
    name: 'ResultsModal',
    props: ['cls'],
    data() {
      return {
        dialogTableVisible: false,
      }
    },
    methods: {

    }
  }
</script>

<style scoped>

</style>

