<template>
  <div class="content-container">
    <h3>Add School</h3>

    <!-- form starts -->
    <el-form ref="schoolForm" :model="schoolForm" :rules="schoolRules">
      <el-col :span="11">
        <el-form-item label="School Name" prop="school_name">
          <el-input v-model="schoolForm.school_name" size="medium" placeholder="School Name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="School Code" prop="school_code">
          <el-input v-model="schoolForm.school_code" size="medium" placeholder="School Code"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="School Gender" prop="school_gender"><br>
          <el-select v-model="schoolForm.school_gender" placeholder="Select School Gender">
            <el-option label="Girls" value="Girls"></el-option>
            <el-option label="Boys" value="Boys"></el-option>
            <el-option label="Mixed" value="Mixed"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="School Level" prop="school_level">
          <el-input v-model="schoolForm.school_level" size="medium" placeholder="School Level"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="Logo url" prop="school_logo">
          <el-input v-model="schoolForm.school_logo" size="medium" placeholder="School Logo (url)"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="School Type" prop="school_type">
          <el-input v-model="schoolForm.school_type" size="medium" placeholder="School Type"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Phone" prop="school_phone">
          <el-input v-model="schoolForm.school_phone" size="medium" placeholder="School Phone"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="E-mail" prop="school_email">
          <el-input v-model="schoolForm.school_email" size="medium" placeholder="School Email"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="School County" prop="school_county">
          <el-input v-model="schoolForm.school_county" size="medium" placeholder="School County"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Sub-County" prop="school_sub_county">
          <el-input v-model="schoolForm.school_sub_county" size="medium" placeholder="School Sub-County"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="School Ward" prop="school_ward">
          <el-input v-model="schoolForm.school_ward" size="medium" placeholder="School Ward"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit('schoolForm')">Save</el-button>
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
          school_level: '',
          school_county: '',
          school_sub_county: '',
          school_ward: '',
          school_logo: ''
        },
        schoolRules: {
          school_name: [
            { required: true, message: 'Please enter the school name', trigger: 'blur' },
            { min: 5, max: 50,  message: 'Length should be a min of 5 and max of 50', trigger: 'blur' }
          ],
          school_code: [
            { required: true, message: 'Please enter the school code', trigger: 'blur' },
            { min: 5, max: 15,  message: 'Length should be a min of 5 and max of 15', trigger: 'blur' }
          ],
          school_type: [
            { required: true, message: 'Please select the school type', trigger: 'blur' }
          ],
          school_gender: [
            { required: true, message: 'Please select the school gender', trigger: 'blur' }
          ],
          school_level: [
            { required: true, message: 'Please select the school level', trigger: 'blur' }
          ],
          school_phone: [
            { required: true, message: 'Please input the school email', trigger: 'blur' },
            // { type: 'number', message: 'Use the email format', trigger: 'blur' }
          ],
          school_email: [
            { required: true, message: 'Please input the school email', trigger: 'blur' },
            { type: 'email', message: 'Use the email format', trigger: 'blur' }
          ],
          school_county: [
            { required: true, message: 'Please input the school County', trigger: 'blur' },
          ],
          school_sub_county: [
            { required: true, message: 'Please input the school Sub-County', trigger: 'blur' },
          ],
          school_ward: [
            { required: true, message: 'Please input the school Ward', trigger: 'blur' }
          ],
          school_logo: [
            { required: true, message: 'Please input the school logo', trigger: 'blur' }
          ]
        }
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

                // reset form
                this.resetForm(schoolForm)
        })
          .catch(err => {
            this.openError()
            console.log(err)
          })
      resetForm(formName) {
        this.$refs[formName].resetFields()
      }
    }
  }
</script>

<style scoped>
  .content-container {
    margin: 20px;
  }
</style>