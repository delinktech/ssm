<template>
  <div class="content-container">
    <h3>Add Class in {{school.school_name}}</h3>

    <!-- form starts -->
    <el-form ref="classForm" :model="classForm" :rules="classRules">
      <el-col :span="11">
        <el-form-item label="Class Name" prop="name">
          <el-input v-model="classForm.name" size="medium" placeholder="Class Code"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Class Code" prop="code">
          <el-input v-model="classForm.code" size="medium" placeholder="Class Code"></el-input>
        </el-form-item>
      </el-col>

      <el-col>
        <el-form-item label="Class Teacher" prop="classTeacher"><br>
          <el-select v-model="classForm.classTeacher" placeholder="lease Select Class Teacher">
            <el-option v-for="teacher in teachers" :key="teacher.first_name" :label="teacher.first_name + ' ' + teacher.teacher_surname" :value="teacher.id"></el-option>
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit('classForm', school.id)">Save</el-button>
      </el-col>

    </el-form>
    <!-- form ends -->
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import { saveClass } from '../../../api/class'

  export default {
    name: 'ClassAddComponent',
    data() {
      return {
        classForm: {
          code: '',
          name: '',
          school: '',
          classTeacher: ''
        },
        classRules: {
          code: [
            { required: true, message: 'Please the class code', trigger: 'blur' },
            { min: 2, max: 5,  message: 'Length should be more than 2', trigger: 'blur' }
          ],
          name: [
            { required: true, message: 'Please class Name', trigger: 'blur' },
            { min: 5, message: 'Length should be more than 5', trigger: 'blur' }
          ],
          classTeacher: [
            { required: true, message: 'Please select the class teacher', trigger: 'blur' }
          ]
        }
      };
    },
    computed: {
      ...mapGetters([
        'school',
        'teachers'
      ])
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
      onSubmit(classForm, school) {
        console.log('>>',school)
        // set users information
        const _class = this.classForm
        _class.school = school

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