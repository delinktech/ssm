<template>
  <div class="content-container">
    <h3>Add Users</h3>

    <!-- form starts -->
    <el-form ref="form" :model="form" :rules="rules">
      <el-col :span="11">
        <el-form-item label="First Name">
          <el-input v-model="form.firstname" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Last Name">
          <el-input v-model="form.lastname" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="11">
        <el-form-item label="User Name">
          <el-input v-model="form.username" size="medium"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="E-mail">
          <el-input v-model="form.email" size="medium"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-form-item label="Phone Number">
          <el-input v-model="form.phone" size="medium"></el-input>
        </el-form-item>
      </el-col>
      
      <el-col :span="7">
        <el-form-item label="School">
          <el-select v-model="form.school" placeholder="Please select school" size="medium">
            <el-option label="School one" value="1"></el-option>
            <el-option label="School two" value="2"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="1">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="User Level">
          <el-select v-model="form.level" placeholder="Please user level" size="medium">
            <el-option label="Head Master" value="head"></el-option>
            <el-option label="Teacher" value="teacher"></el-option>
            <el-option label="Sec" value="sec"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="7">
        <el-form-item label="Teacher?">
          <el-switch v-model="form.hasTeacherObject"></el-switch>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-form-item label="User Roles">
          <el-checkbox-group v-model="form.roles">
            <el-checkbox label="Admin" name="type"></el-checkbox>
            <el-checkbox label="Head Master" name="type"></el-checkbox>
            <el-checkbox label="Dean" name="type"></el-checkbox>
            <el-checkbox label="Teacher" name="type"></el-checkbox>
          </el-checkbox-group>
        </el-form-item>
      </el-col>

      <el-col :span="11">
        <el-form-item label="Password" prop="pass">
          <el-input type="password" v-model="form.password" size="medium" auto-complete="off"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="2">&nbsp;</el-col>
      <el-col :span="11">
        <el-form-item label="Confirm" prop="checkPass">
          <el-input type="password" v-model="checkPass" size="medium" auto-complete="off"></el-input>
        </el-form-item>
      </el-col>

      <el-col :span="24">
        <el-button type="success" style="margin-top: 12px;" @click="onSubmit(form)">Save</el-button>
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
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password'));
        } else {
          if (this.form.password !== '') {
            this.$refs.form.validateField('checkPass');
          }
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password again'));
        } else if (value !== this.form.password) {
          callback(new Error('Two inputs don\'t match!'));
        } else {
          callback();
        }
      };
      return {
        active: 1,
        form: {
          firstname: '',
          lastname: '',
          username: '',
          email: '',
          phone: '',
          roles: [],
          school: '',
          password: '',
          level: '',
          avatar: '',
          hasTeacherObject: ''
        },
        checkPass: '',
        rules: {
          password: [
            { validator: validatePass, trigger: 'blur' }
          ],
          checkPass: [
            { validator: validatePass2, trigger: 'blur' }
          ]
        }
      };
    },

    methods: {
      next() {
        if (this.active++ > 2) this.active = 1;
      },
      onSubmit() {
        // save user
        saveUser(this.form).then(res => {
          // successful save
        })
          .catch(err => {
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