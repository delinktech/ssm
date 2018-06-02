<template>
  <div>
    <el-popover ref="popover" placement="top" width="260" v-model="visible">
      <p>Are you sure you want to send emails to parents of class {{cls[0].classInfo.name}}?</p>
      <div style="text-align: right; margin: 0">
        <el-button size="mini" type="text" @click="visible=false">cancel</el-button>
        <el-button type="primary" size="mini" @click="sendMails(cls[0])">confirm</el-button>
      </div>
    </el-popover>

    <!-- display button to send emails -->
    <el-tooltip content="Notify Parents" placement="bottom">
      <el-button  v-popover:popover type="text" size="small"><md-icon>send</md-icon></el-button>
    </el-tooltip>

  </div>
</template>

<script>
  import { notifyParents } from "../../../../api/results";
  export default {
    name: 'NotifyPopover',
    props: ['cls'],
    data() {
      return {
        visible: false,
      }
    },
    methods: {
      sendMails(cls) {
        this.$emit('sending', true) // show the loading

        const sendInfo = {
          year: cls.year,
          term: cls.term,
          class: cls.class
        }
        console.log('class selected', cls)
        console.log('sending this', sendInfo)

        // call api to notify parents
        notifyParents(sendInfo)
          .then(res => {
            // success sending mails
            this.$emit('sending', false)   // stop the loader
            console.log('response:', res)
            this.openSuccess()
          })
          .catch(err => {
            // error while sending emails
            this.$emit('sending', false)   // stop the loader
            console.log('error', err)
            this.openError()
          })

        // hide the confirmation popover
        this.visible = false
      },
      openSuccess() {
        this.$notify.success({
          title: 'Success',
          message: 'Emils sent to parents',
          offset: 100
        })
      },
      openError() {
        this.$notify.error({
          title: 'Error',
          message: 'Emils not sent to parents',
          offset: 100
        })
      }
    }
  }
</script>
