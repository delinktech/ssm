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

    <el-steps :active="active" finish-status="success"> <!--- steps begins -->
      <el-step title="Student Info"></el-step>
      <el-step title="Parent Info"></el-step>
    </el-steps>

    <el-form ref="studentForm" :model="studentForm" :rules="studentRules" v-if="active === 1"> <!-- student form starts -->
      <el-col :span="11">
        <el-form-item label="School" prop="school">
          <el-input disabled v-model="studentForm.school" size="medium" placeholder="School"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Registration Num" prop="student_reg">
          <el-input v-model="studentForm.student_reg" size="medium" placeholder="Reg Number"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="First Name" prop="firstName">
          <el-input v-model="studentForm.firstName" size="medium" placeholder="First Name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Second Name" prop="secondName">
          <el-input v-model="studentForm.secondName" size="medium" placeholder="Second Name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="Last Name" prop="lastName">
          <el-input v-model="studentForm.lastName" size="medium" placeholder="Last Name"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="8">
        <el-form-item label="Date of Bith" prop="dob"><br>
          <el-date-picker v-model="studentForm.dob" type="date" placeholder="Pick Date of Birth" :picker-options="pickerOptions" size="medium"></el-date-picker>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Gender" prop="gender"><br>
          <el-radio v-model="studentForm.gender" label="Male">Male</el-radio>
          <el-radio v-model="studentForm.gender" label="Female">Female</el-radio>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Class" prop="class"><br>
          <el-select v-model="studentForm.class" placeholder="Please select class" size="medium">
            <el-option label="4 West" value="32"></el-option>
            <el-option label="3 North" value="233"></el-option>
            <el-option label="8 South" value="1324"></el-option>
          </el-select>
        </el-form-item>
      </el-col>

    </el-form> <!-- /students form ends -->

    <el-form ref="parentForm" :model="parentForm" v-if="active === 2"> <!-- /parents form begins -->
      <el-col :span="11">
        <el-form-item label="First Name" prop="firstname">
          <el-input v-model="parentForm.firstname" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Last Name" prop="secondname">
          <el-input v-model="parentForm.secondname" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="Phone" prop="phone">
          <el-input v-model="parentForm.phone" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="E-Mail" prop="email">
          <el-input v-model="parentForm.email" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Natioanl ID" prop="nationalId">
          <el-input v-model="parentForm.nationalId" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="County" prop="county">
          <el-input v-model="parentForm.county" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="Sub-County" prop="sub_county">
          <el-input v-model="parentForm.sub_county" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Ward" prop="">
          <el-input v-model="parentForm.ward" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px; float: right;" @click="onSubmit()">All Done Save</el-button>
      </el-col>
    </el-form> <!-- /parents form ends -->
    <br>
    <el-button style="margin-top: 12px;" @click="next('studentForm')">Next step <i class="el-icon-arrow-right el-icon-right"></i></el-button>
  </div>
</template>

<script>
  import { getSchool } from '../../../api/schools'
  import { saveStudent } from '../../../api/students'
  import { saveParent } from '../../../api/parents'

  export default {
    name: 'StudentAddComponent',
    data() {
      return {
        active: 1,
        schoolInfo: null,
        schClasses: null,
        parentForm: {
          firstname: '',
          secondname: '',
          phone: '',
          email: '',
          nationalId: '',
          county: '',
          sub_county: '',
          ward: ''
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
      openSucess() {
        this.$message({
          message: 'Student & Parent Saved Successfuly',
          type: 'success'
        })
      },
      openError(object) {
        this.$message({
          message: `Oops! Something went wrong while saving! ${object}`,
          type: 'error'
        })
      },
      fetchSchool() {
        getSchool(1).then(res => {
          this.school = res.data.data

          // TODO: get the schools classes
          // getClasses().then(r => {
          //   schClasses = r.data
        })
      },
      onSubmit() {
        if (this.parentForm && this.studentForm) {
          // post data to api
          console.log('parent=>', this.parentForm)
          console.log('student=>', this.studentForm)
          // TODO: on success parent save get parent and save student

          saveParent(this.parentForm)
            .then(resParent => {
              console.log('res 1', resParent)

              const updateStudent = this.studentForm
              updateStudent.parent = resParent.id

              // save student
              saveStudent(updateStudent)
                .then(resStudent => {
                  this.openSucess()
                  console.log('res 1', resStudent)
                })
                .catch(e => {
                  this.openError('Student')
                  console.log('error saving student', e)
                })
            })
            .catch(e => {
              this.openError('Parent')
              console.log('error saving parent', e)
            })
        }
      },
      next() {
        if (this.active++ > 1) this.active = 1
      }
    }
  }
</script>

<style scoped>
  
</style>
