<template>
  <div class="content-container">
    <h3>Add School</h3>

    <!-- alert -->
    <el-alert v-if="successSave"
      title="success alert"
      type="success"
      show-icon>
    </el-alert>

    <!-- form starts -->
    <el-form ref="form" :model="schoolForm">
      <el-col :span="11">
        <el-form-item label="School Name">
          <el-input v-model="schoolForm.school_name" size="medium" placeholder="School Name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="School Code">
          <el-input v-model="schoolForm.school_code" size="medium" placeholder="School Code"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="11">
        <el-form-item label="School Gender">
          <el-select v-model="schoolForm.school_gender" placeholder="Select School Gender">
            <el-option label="Girls" value="Girls"></el-option>
            <el-option label="Boys" value="Boys"></el-option>
            <el-option label="Mixed" value="Mixed"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item>
          <el-input v-model="schoolForm.school_logo" size="medium" placeholder="School Logo (url)"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="School Type">
          <el-input v-model="schoolForm.school_type" size="medium" placeholder="School Type"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Phone">
          <el-input v-model="schoolForm.school_phone" size="medium" placeholder="School Phone"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="E-mail">
          <el-input v-model="schoolForm.school_email" size="medium" placeholder="School Email"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="School County">
          <el-input v-model="schoolForm.school_county" size="medium" placeholder="School County"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Sub-County">
          <el-input v-model="schoolForm.school_sub_county" size="medium" placeholder="School Sub-County"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="School Ward">
          <el-input v-model="schoolForm.school_ward" size="medium" placeholder="School Ward"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit(schoolForm)">Save</el-button>
      </el-col>

    </el-form>
    <!-- form ends -->
  </div>
</template>

<script>
  import { saveSchool } from '../../../api/schools'

  export default {
    name: 'SchoolAddComponent',
    data() {
      return {
        schoolForm: {
          school_name: '',
          school_code: '',
          school_type: '',
          school_phone: '',
          school_email: '',
          school_gender: '',
          school_county: '',
          school_sub_county: '',
          school_ward: '',
          school_logo: ''
        },
        successSave: false
      };
    },
    methods: {
      openSucess() {
        this.$message({
          message: 'School Saved Successfuly',
          type: 'success'
        })
      },
      openError() {
        this.$message({
          message: 'Oops! School Not saved!',
          type: 'error'
        })
      },
      onSubmit() {
        // set users information
        const schoolData = this.schoolForm
        console.log('data', schoolData)

        // proceed to save to db
        saveSchool(schoolData).then(res => {
          this.successSave = true
          this.schoolForm = null
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