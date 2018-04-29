<template>
  <div class="content-container">
    <h3>Add Users</h3>

    <!-- form starts -->
    <el-form ref="userForm" :model="userForm" :rules="rules" status-icon>
      <el-col :span="11">
        <el-form-item label="First Name"  prop="firstname">
          <el-input v-model="userForm.firstname" size="medium" placeholder="First Name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Last Name" prop="lastname">
          <el-input v-model="userForm.lastname" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="11">
        <el-form-item label="User Name" prop="username">
          <el-input v-model="userForm.username" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="E-mail" prop="email">
          <el-input v-model="userForm.email" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-form-item label="Phone Number" prop="phone">
          <el-input v-model="userForm.phone" size="medium"></el-input>
        </el-form-item>
      </el-col>
      
      <el-col :span="7">
        <el-form-item label="School" prop="school">
          <el-select v-model="userForm.school" placeholder="Please select school" size="medium">
            <el-option label="School one" value="1"></el-option>
            <el-option label="School two" value="2"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="User Level" prop="level">
          <el-select v-model="userForm.level" placeholder="Please user level" size="medium">
            <el-option label="Head Master" value="head"></el-option>
            <el-option label="Teacher" value="teacher"></el-option>
            <el-option label="Sec" value="sec"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Teacher?" prop="hasTeacherObject"> <br>
          <el-switch v-model="userForm.hasTeacherObject"></el-switch>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-form-item label="User Roles" prop="roles">
          <el-checkbox-group v-model="userForm.roles">
            <el-checkbox label="Admin" name="type"></el-checkbox>
            <el-checkbox label="Head Master" name="type"></el-checkbox>
            <el-checkbox label="Dean" name="type"></el-checkbox>
            <el-checkbox label="Teacher" name="type"></el-checkbox>
          </el-checkbox-group>
        </el-form-item>
      </el-col>

      <el-col :span="11">
        <el-form-item label="Password" prop="password">
          <el-input type="password" v-model="userForm.password" size="medium" auto-complete="off"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Confirm" prop="checkPass">
          <el-input type="password" v-model="userForm.checkPass" size="medium" auto-complete="off"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="primary" :disabled=isValid style="margin-top: 12px;" @click="onSubmit('userForm')">Save</el-button>
      </el-col>

    </el-form>
    <!-- form ends -->
  </div>
</template>

<script>
  import { saveUser } from '../../../api/users'

  export default {
    name: 'UsersAddComponent',
    data() {
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password again'))
        } else if (value !== this.userForm.password) {
          alert(value)
          callback(new Error('Two inputs don\'t match!'))
        } else {
          callback();
        }
      };
      return {
        userForm: {
          firstname: '',
          lastname: '',
          username: '',
          email: '',
          phone: '',
          roles: [],
          school: '',
          level: '',
          password: '',
          avatar: '',
          hasTeacherObject: '',
          checkPass: ''
        },
        rules: {
          firstname: [
            { required: true, message: 'Please input first name', trigger: 'blur' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          lastname: [
            { required: true, message: 'Please input last name', trigger: 'change' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          username: [
            { required: true, message: 'Please input the username', trigger: 'change' },
            { min: 3, message: 'Length should be more than 3', trigger: 'blur' }
          ],
          email: [
            { required: true, message: 'Please input user', trigger: 'change' },
            { type: 'email', message: 'Please input correct email address', trigger: ['blur', 'change']  }
          ],
          phone: [
          // TODO: validate phone number
            { required: true, message: 'Please input the username number', trigger: 'change' },
            { min: 10, message: 'Please input the correct phone format', trigger: ['blur', 'change'] }
          ],
          roles: [
           { type: 'array', required: true, message: 'Please select at least one role', trigger: 'change' }
          ],
          school: [
           { required: true, message: 'Please select the school', trigger: 'change' }
          ],
          level: [
           { required: true, message: 'Please select user level', trigger: 'change' }
          ],
          password: [
            { required: true, message: 'Please input user password', trigger: 'blur' },
            { min: 5, message: 'Password should be atleast 5 chars', trigger: 'blur' }
          ],
          checkPass: [
            { validator: validatePass2, trigger: 'blur' }
          ]
        }
      };
    },
    computed: {
      // TODO: check form validation at this point
      isValid () { return false}
    },
    methods: {
      openSucess() {
        this.$message({
          message: 'User Saved Successfuly :)',
          type: 'success'
        })
      },
      openError(object) {
        this.$message({
          message: `Oops! ${object}`,
          type: 'error'
        })
      },
      onSubmit(userForm) {
        // set users information
        const data = this.userForm
        data.avatar = 'https://cdn.pixabay.com/photo/2016/03/31/19/57/avatar-1295406_960_720.png'

        this.$refs[userForm].validate((valid) => {
          if (valid) {
            data.roles = this.userForm.roles[0]

            // proceed to save to db
            saveUser(data)
              .then(res => {
                // success saved the user
                this.userForm = null
                this.openSucess()
              })
              .catch(err => {
                // error while saving user
                this.openError(err.body.message)
              })
          } else {
            // not a valid form
            console.log('fill all fields!!')
            return false
          }
        });
      }
    }
  }
</script>

<style scoped>
  .content-container {
    margin: 20px;
  }
</style>
