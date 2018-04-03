<template>
  <div class="app-container">
    <h3>Add Student</h3>

    <!--
      TODO: add steps to add the parent information on this component
      * first input the student infomation on the first step
      * second input the parent information the second step
      * on submit first save the parent to the db
      * return the parent objet the ui and pick the parent id
      * save the student with parent information on the background
      >>> smile all the way :)
    -->

    <!-- form starts -->
    <el-form ref="form" :model="studentForm">
      <el-col :span="11">
        <el-form-item label="School">
          <el-input v-model="studentForm.school" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Registration Num">
          <el-input v-model="studentForm.regNum" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="First Name">
          <el-input v-model="studentForm.firstName" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Second Name">
          <el-input v-model="studentForm.secondName" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Last Name">
          <el-input v-model="studentForm.lastName" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="Date of Bith">
          <el-date-picker v-model="studentForm.dob" type="date" placeholder="Pick Date of Birth" :picker-options="pickerOptions" size="medium"></el-date-picker>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Gender">
          <el-radio v-model="studentForm.gender" label="Male" border size="medium">Male</el-radio>
          <el-radio v-model="studentForm.gender" label="Female" border size="medium">Female</el-radio>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Class">
          <el-select v-model="studentForm.class" placeholder="Please select class" size="medium">
            <el-option label="4 West" value="324545"></el-option>
            <el-option label="3 North" value="233"></el-option>
            <el-option label="8 South" value="1324"></el-option>
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit(form)">Save Student</el-button>
    <el-form ref="parentForm" :model="parentForm" v-if="active === 2"> <!-- /parents form begins -->
      <el-col :span="11">
        <el-form-item label="First Name">
          <el-input v-model="parentForm.firstname" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Last Name">
          <el-input v-model="parentForm.seconname" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="Phone">
          <el-input v-model="parentForm.phone" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="E-Mail">
          <el-input v-model="parentForm.email" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Natioanl ID">
          <el-input v-model="parentForm.nationalId" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="County">
          <el-input v-model="parentForm.county" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="Sub-County">
          <el-input v-model="parentForm.sub_county" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Ward">
          <el-input v-model="parentForm.ward" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit">All Done Save</el-button>
      </el-col>
    </el-form> <!-- /parents form ends -->

    <el-button style="margin-top: 12px;" @click="next">Next step</el-button>
  </div>
</template>

<script>
  import { getSchool } from '../../../api/schools'

  export default {
    name: 'StudentAddComponent',
    data() {
      return {
        schoolInfo: null,
        schClasses: null,
        parentForm: {
          firstName: '',
          secondName: '',
          phone: '',
          email: ''
        },
        studentForm: {
          regNum: 'MTNT/2018/2579',

          firstName: '',
          secondName: '',
          lastName: '',
          gender: '',
          dob: '',

          school: 'Imara Daima Pri School',
          class: '',

          parent: ''
        },
        pickerOptions: {
          disabledDate(time) {
            return time.getTime() > Date.now()
          }
        }
      }
    },
    filters: {
      
    },
    created() {
      // TODO: fatch data required before saving students
      // this.fetchSchool()
    },
    methods: {
      fetchSchool() {
        // getSchool(1).then(res => {
        //   this.school = res.data

        //   // TODO: get the schools classes
        //   // getClasses().then(r => {
        //   //   schClasses = r.data
        //   // })
        // })
      },
      onSubmit() {
        if (this.parentForm.valid) {
          // post data to api

          // TODO: on success parent save get parent and save student
        }
      }
    }
  }
</script>

<style scoped>
  
</style>
