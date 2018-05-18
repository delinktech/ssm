<template>
  <div class="user-list">
    <h3>List of Users</h3>
    <el-table :data="users" stripe style="width: 100%">
      <el-table-column prop="user_firstname" label="First Name" width="180"></el-table-column>
      <el-table-column prop="user_lastname" label="Last Name" width="180"></el-table-column>
      <el-table-column prop="user_phone" label="Phone"></el-table-column>
      <el-table-column prop="email" label="Email"></el-table-column>
      <el-table-column prop="roles" label="Roles"></el-table-column>
    </el-table>
  </div>
</template>

<script>
  import { getUsers } from '../../../api/users'

  export default {
    name: 'UsersListComponet',
    data() {
      return {
        users: null,
        loadingUsers: false,
      }
    },
    created() {
      this.fetchUsers()
    },
    methods: {
      successMesssage() {
        this.$message({
          message: 'User deleted successfuly',
          type: 'success'
        });
      },
      openError(err) {
        this.$message({
          message: `Oops! Something went wrong! ${err}`,
          type: 'error'
        })
      },
      fetchUsers() {
        this.loadingUsers = true
        getUsers()
          .then(res => {
            // all good with users fetch
            this.users = res.data.users

            // stop the loader
            this.loadingUsers = false
          })
          .catch(err => {
            // catch the error here
            console.log('error::', err)
            this.openError('fetching users')

            // stop the loader
            this.loadingUsers = false
          })
      }
    }
  }
</script>

<style scoped>
.user-list {
  margin: 15px;
}
</style>
