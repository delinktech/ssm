<template>
  <div>
    <el-popover ref="popover" placement="top" width="260" v-model="visible">
      <p>Are you sure you want to send emails to parents?</p>
      <div style="text-align: right; margin: 0">
        <el-button size="mini" type="text" @click="visible = false">cancel</el-button>
        <el-button type="primary" size="mini" @click="sendMails()">confirm</el-button>
      </div>
    </el-popover>

    <!-- display button to send emails -->
    <el-tooltip content="Notify Parents" placement="bottom">
      <el-button  v-popover:popover type="text" size="small"><md-icon>send</md-icon></el-button>
    </el-tooltip>
  </div>
</template>

<script>
  export default {
    name: 'NotifyPopover',
    props: ['cls'],
    data() {
      return {
        visible: false,
      }
    },
    methods: {
      sendMails() {
        this.visible = false
      }
    }
  }
</script>
