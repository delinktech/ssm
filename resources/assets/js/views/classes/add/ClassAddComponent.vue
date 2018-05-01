<template>
  <div class="content-container">
    <h3>Add Class</h3>

    <!-- form starts -->
    <el-form ref="form" :model="classForm">
      <el-col :span="11">
        <el-form-item label="Class Name">
          <el-input v-model="classForm.name" size="medium" placeholder="Class Code"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Class Code">
          <el-input v-model="classForm.code" size="medium" placeholder="Class Code"></el-input>
        </el-form-item>
      </el-col>

      <el-col>
        <el-form-item label="Class Teacher"><br>
          <el-select v-model="classForm.classTeacher" placeholder="lease Select Class Teacher">
            <el-option label="Mr.Ngugi" value="1"></el-option>
            <el-option label="Mrs.Karanja" value="2"></el-option>
            <el-option label="Ms.Otieno" value="3"></el-option>
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit(classForm)">Save</el-button>
      </el-col>

    </el-form>
    <!-- form ends -->
  </div>
</template>

<script>
  import { saveClass } from '../../../api/class'

  export default {
    name: 'ClassAddComponent',
    data() {
      return {
        classForm: {
          code: '',
          name: '',
          school: 1,
          classTeacher: ''
        },
        successSave: false
      };
    },
    methods: {
      openSucess() {
        this.$message({
          message: 'class Saved Successfuly',
          type: 'success'
        })
      },
      openError() {
        this.$message({
          message: 'Oops! Class Not saved! try again',
          type: 'error'
        })
      },
      onSubmit() {
        // set users information
        const _class = this.classForm
        console.log('data', _class)

        // proceed to save to db
        saveClass(_class)
            .then(res => {
            this.successSave = true
            this.classForm = null
            this.openSucess()
          })
          .catch(err => {
            this.openError()
            console.log(err)
          })
      }
    }
  }
</script>

<style scoped>
  .content-container {
    margin: 20px;
  }
</style>