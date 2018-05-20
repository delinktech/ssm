<template>
  <div>
    <!-- click button to view results -->
    <el-tooltip content="View Results" placement="bottom">
      <el-button  @click="dialogTableVisible=true" type="text" size="small"><md-icon>view_list</md-icon></el-button>
    </el-tooltip>

    <!-- display rsults in a table -->
    <el-dialog title="Shipping address" :visible.sync="dialogTableVisible" width="80%">
      <el-table :data="cls.results">
        <el-table-column property="date" label="Date" width="150"></el-table-column>
        <el-table-column property="name" label="Name" width="200"></el-table-column>
        <el-table-column property="address" label="Address"></el-table-column>
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

