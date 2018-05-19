<template>
  <div>
    <el-popover ref="popover" placement="top" width="260" v-model="visible">
      <p>Are you sure you want to send emails to parents?</p>
      <div style="text-align: right; margin: 0">
        <el-button size="mini" type="text" @click="visible = false">cancel</el-button>
        <el-button type="primary" size="mini" @click="sendMails()">confirm</el-button>
      </div>
    </el-popover>

    <el-tooltip content="Notify Parents" placement="bottom">
      <md-icon v-popover:popover style="float: right;">send</md-icon>
    </el-tooltip>
  </div>
</template>

<script>
  export default {
    name: 'NotifyPopover',
    data() {
      return {
        visible: false,
      }
    },
    methods: {
      sendMails() {
        this.visible = false
        alert('sending emails.....')
      }
    }
  }
</script>

