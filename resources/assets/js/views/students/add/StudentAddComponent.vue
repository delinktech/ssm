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
        <el-form-item label="Registration Number" prop="student_reg">
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
            <el-option v-for="cls in classes" :key="cls.code" :label="cls.name" :value="cls.id"></el-option>
          </el-select>
        </el-form-item>
      </el-col>

      <br>
      <el-button style="margin-top: 12px; clear: both; float: left;" @click="next('studentForm')">Next step <i class="el-icon-arrow-right el-icon-right"></i></el-button>
    </el-form> <!-- /students form ends -->

    <el-form ref="parentForm" :model="parentForm" :rules="parentRules" v-if="active === 2"> <!-- /parents form begins -->
      <el-col :span="11">
        <el-form-item label="First Name" prop="firstname">
          <el-input v-model="parentForm.firstname" size="medium" placeholder="First Name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Last Name" prop="secondname">
          <el-input v-model="parentForm.secondname" size="medium" placeholder="Second Name"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="Phone" prop="phone">
          <el-input v-model="parentForm.phone" size="medium" placeholder="Phone Number"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="E-Mail" prop="email">
          <el-input v-model="parentForm.email" size="medium" placeholder="E-Mail Address"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Natioanl ID" prop="nationalId">
          <el-input v-model="parentForm.nationalId" size="medium" placeholder="National Id"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="7">
        <el-form-item label="County" prop="county">
          <el-input v-model="parentForm.county" size="medium" placeholder="County"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="8">
        <el-form-item label="Sub-County" prop="sub_county">
          <el-input v-model="parentForm.sub_county" size="medium" placeholder="Sub-County"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Ward" prop="ward">
          <el-input v-model="parentForm.ward" size="medium" placeholder="Ward"></el-input>
        </el-form-item>
      </el-col>

      <el-button type="success" style="margin-top: 12px; float: right;" @click="onSubmit('parentForm', 'studentForm')">All Done Save</el-button>

      <br>
      <el-button style="margin-top: 12px;" @click="prev"><i class="el-icon-arrow-left el-icon-left"></i> Prev step</el-button>
    </el-form> <!-- /parents form ends -->
  </div>
</template>

<script>
  import moment from 'moment'
  import { mapGetters } from 'vuex'
  import { getSchool } from '../../../api/schools'
  import { saveStudent } from '../../../api/students'
  import { saveParent } from '../../../api/parents'

  export default {
    name: 'StudentAddComponent',
    data() {
      const stuReg = 'SCH/' + moment(new Date()).format('YYYY-DD/hmmss');
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
          student_reg: stuReg,

          firstName: '',
          secondName: '',
          lastName: '',
          gender: '',
          dob: '',

          school: 1,
          class: '',

          parent: ''
        },
        pickerOptions: {
          disabledDate(time) {
            return time.getTime() > Date.now()
          }
        },
        studentRules: {
          // student form rules
          student_reg: [
            { required: true, message: 'Please input student reg number', trigger: 'blur' },
            { min: 5, message: 'Length should be more than 5', trigger: 'blur' }
          ],
          firstName: [
            { required: true, message: 'Please input first name', trigger: 'change' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          secondName: [
            { required: true, message: 'Please input the second name', trigger: 'change' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          lastName: [
            { required: true, message: 'Please input last name', trigger: 'change' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          gender: [
            { required: true, message: 'Please pick gender', trigger: 'change' },
          ],
          dob: [
           { type: 'date', required: true, message: 'Please pick date of birth', trigger: 'change' }
          ],
          school: [
           { required: true, message: 'School is required', trigger: 'change' }
          ],
          class: [
           { required: true, message: 'Please Pick a class', trigger: 'change' }
          ]
        },
        parentRules: {
          // parent form rules
          firstname: [
            { required: true, message: 'Please input parent name', trigger: 'blur' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          secondname: [
            { required: true, message: 'Please input second name', trigger: 'change' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          phone: [
            { required: true, message: 'Please input parent phone number', trigger: 'change' },
            { min: 10, message: 'Length should be more than 10', trigger: 'blur' }
          ],
          email: [
            // { required: true, message: 'Please input parent email', trigger: 'change' },
            { type: 'email', message: 'Use the email format', trigger: 'blur' }
          ],
          nationalId: [
            { required: true, message: 'Please input parent id number', trigger: 'change' },
            { min: 5, message: 'Length should be more than 5', trigger: 'blur' }
          ],
          county: [
           { required: true, message: 'Please indicate county residence', trigger: 'change' },
           { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          sub_county: [
           { required: true, message: 'PLease indicate sub-county of residence', trigger: 'change' },
           { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          ward: [
           { required: true, message: 'PLease indicate ward of residence', trigger: 'change' },
           { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ]
        }
      };
    },
    computed: {
      ...mapGetters([
        'school',
        'teachers',
        'classes'
      ])
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
      onSubmit(parentForm, studentForm) {
        this.$refs[parentForm].validate((valid) => {
          if (valid) {
            // all good valid forms
            // post data to api
            saveParent(this.parentForm)
              .then(resParent => {
                // success saving parent

                // get parent id 
                const updateStudent = this.studentForm
                updateStudent.dob = moment(this.studentForm.dob).format('YYYY-MM-DD')
                updateStudent.parent = resParent.data.parent.id

                // save student
                saveStudent(updateStudent)
                  .then(resStudent => {
                    // reset forms
                    // this.resetForm(parentForm) // reset parent form
                    // this.resetForm(studentForm) // reset student form

                    console.log('student', resStudent.data)
                    // successsaving student
                    this.openSucess()
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
          } else {
            // invalid form
            return false
          }
        })
      },
      resetForm(formName) {
        this.$refs[formName].resetFields()
      },
      prev() {
        this.active--
      },
      next(studentForm) {
        this.$refs[studentForm].validate((valid) => {
          if (valid) {
            // valid form move to next screen
            this.active++
            // if (this.active++ > 1) this.active = 1
          } else {
            // invalid form
            return false
          }
        })
      }
    }
  }
</script>

<style scoped>
  
</style>
