<!-- @format -->

<template>
  <div class="todo-content">
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption caption-md">
          <i class="icon-bar-chart theme-font hide"></i>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-10">
                <span class="caption-subject text-orange bold uppercase"
                  ><h4>
                    {{ contact.contact }}
                    <small> {{ '+63' + contact.mobile }} </small>
                  </h4>
                </span>
              </div>
              <div class="col-md-2" style="text-align: right">
                <label class="switch">
                  <input
                    type="checkbox"
                    checked
                    v-if="contact.status === 'active'"
                    id="close_status"
                    @input="change_chat_status(contact.id, 'closed')"
                  />
                  <input
                    type="checkbox"
                    v-if="contact.status === 'closed'"
                    id="active_status"
                    @input="change_chat_status(contact.id, 'active')"
                  />
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="portlet-body"
        style="overflow: auto; width: auto; height: 445px; border: 1px solid #eee;"
        id="msg_history"
      >
        <div class="messages">
          <div v-if="messages.length > 0" class="msg_history">
            <template v-for="(message, messageIndex) in messages">
              <div
                v-if="message.sender != 'backend'"
                :key="messageIndex"
                class="incoming_msg"
              >
                <div class="incoming_msg_img">
                  <img
                    v-if="message.sender === 'salesman'"
                    :src="`/assets/img/profile-photos/3.png`"
                    class="img-sm img-circle"
                  />
                  <img
                    v-if="message.sender === 'customer'"
                    :src="`/assets/img/profile-photos/1.png`"
                    class="img-sm img-circle"
                  />
                </div>
                <div class="received_msg">
                  <div class="received_with_msg">
                    <p>{{ message.body }}</p>
                    <span class="time_date">
                      {{ message.sent_at | formatSentDateTime }}</span
                    >
                  </div>
                </div>
              </div>

              <div v-else :key="messageIndex" class="outgoing_msg">
                <div class="sent_msg">
                  <p>{{ message.body }}</p>
                  <span class="time_date">
                    <span>
                      {{ message.sent_at | formatSentDateTime }}
                    </span>
                    <span v-html="msgStatus(message.status)"></span>
                  </span>
                </div>
              </div>
            </template>
          </div>
          <!-- <div v-else class="text-center">
            <h4 class="bold">Start chatting with {{ contact.contact }}</h4>
          </div> -->
        </div>
      </div>
      <div class="portlet-footer">
        <div class="type_msg">
          <form method="post" id="form_chat_area">
            <div class="form-group">
              <!-- <textarea
                v-model.trim="message"
                class="form-control"
                placeholder="Type a message"
                style="resize: none;"
                id="send_message"
                v-if="
                  contact.status === 'closed' && contact.disabled_by === user
                "
                required
              ></textarea> -->
              <textarea
                v-model.trim="message"
                class="form-control"
                placeholder="Type a message"
                style="resize: none;"
                id="send_message"
                @keydown="sendMessage"
                :disabled="
                  contact.status === 'closed' && contact.disabled_by === user
                "
                required
              ></textarea>
            </div>
          </form>
           <div class="form-group">
            <button
              class="btn btn-block btn-primary"
              v-if="contact.status === 'closed'"
              type="text"
              disabled
            >
              <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
              ADD ADDITIONAL ORDER
            </button>
            <button
              class="btn btn-block btn-primary"
              v-if="contact.status === 'active'"
              type="text"
              @click="setSelectedTransaction(contact.account_code)"
            >
              <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> ADD
              ADDITIONAL ORDER
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NProgress from 'nprogress'
import { format } from 'date-fns'

export default {
  props: {
    contactData: {
      required: true
    }
  },
  data() {
    return {
      messages: [],
      messageStatus: [],
      message: null,
      close_status: 0,
      active_status: 1,
      user: null
    }
  },
  computed: {
    contact() {
      return JSON.parse(atob(this.contactData))
    }
  },
  mounted() {
    // Echo.channel('distribution-messenger').listen('.new-message', e => {
    //   this.retrieveMessages()
    //   alert('new message')
    // })
    setInterval(() => this.retrieveMessages(), 10000)
    this.user = this.$root.authUser.name
  },
  filters: {
    formatSentDateTime(dateTime) {
      const time = format(new Date(dateTime), 'p')
      const date = format(new Date(dateTime), 'MMM dd')
      return `${time} | ${date}`
    }
  },
  watch: {
    $route() {
      this.retrieveMessages()
    }
  },
  methods: {
    setSelectedTransaction(data) {
      this.$emit('setSelectedTransactionEmit', data)
    },
    async retrieveMessages() {
      

      const { data } = await axios.get(
        `/messenger/retrieve/${this.contact.account_code}/${this.contact.ref_no}`
      )
      this.messages = []
      this.messages = data.map(message => {
        return { ...message, status: 1 }
      })

      this.scrollToLatestMessage()

      NProgress.done()
    },

    change_chat_status(id, status) {
      axios
        .get(`/messenger/deactivate_chat/?id=${id}&status=${status}`)
        .then(({ data }) => {
          if (data.trim() == 'Success') {
            if (status == 'closed') {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message:
                  '<i class="fa fa-check"></i> Status is now Deactivated.',
                container: 'floating',
                timer: 5000
              })
            } else {
              $.niftyNoty({
                type: 'info',
                icon: 'pli-cross icon-2x',
                message: "<i class='fa fa-check'></i> Status is now Activated.",
                container: 'floating',
                timer: 5000
              })
            }
          } else {
            if (data.trim() == 'Error') {
              if (status == '1') {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already active.",
                  container: 'floating',
                  timer: 5000
                })
              } else {
                $.niftyNoty({
                  type: 'danger',
                  icon: 'pli-cross icon-2x',
                  message:
                    "<i class='fa fa-exclamation-circle'></i> Invalid, it's already inactive.",
                  container: 'floating',
                  timer: 5000
                })
              }
            }
          }
          window.location = '/tele_ordering'
        })
        .catch(error => {})
    },
    async sendMessage(e) {
      if (e.keyCode === 13 && !e.shiftKey) {
        if (this.message.trim().length === 0) {
          return
        }
        e.preventDefault()
        const formData = new FormData()

        formData.append('message', this.message)
        formData.append('contactCode', this.contact.account_code)
        formData.append('contactRef', this.contact.ref_no)

        const message = {
          body: this.message,
          sent_at: new Date(),
          to_id: this.contact.id,
          sender: 'backend',
          status: 0
        }

        this.messages.push(message)
        this.message = null

        this.scrollToLatestMessage()

        try {
          const { status } = await axios.post(`/messenger`, formData)

          const latestMessage = this.messages.length - 1

          if (status === 200) {
            this.messages[latestMessage].status = 1
          }
        } catch (error) {
          this.messages[latestMessage].status = 2
        }

        // this.retrieveMessages()
      }
    },
    msgStatus(status) {
      if (status === 0) {
        return '<i class="fa fa-spinner fa-pulse"></i>'
      }

      if (status === 1) {
        return '<i class="fa fa-check-circle" style="color: #ff5722;"></i>'
      }

      if (status === 2) {
        return '<i class="fa fa-ban"></i>'
      }
    },
    scrollToLatestMessage() {
      const messages = document.getElementById('msg_history')

      setTimeout(() => {
        messages.scrollTop = messages.scrollHeight
      }, 50)
    }
  },
  created() {
    this.retrieveMessages()
  }
}
</script>

<style scoped>
.message_body pre {
  white-space: pre-wrap;
  word-wrap: break-word;
  font-family: inherit;
}

.incoming_msg {
  padding-bottom: 2rem;
}

img {
  max-width: 100%;
}

.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%;
  border-right: 1px solid #c4c4c4;
}

.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}

.top_spac {
  margin: 20px 0 0;
}

.recent_heading {
  float: left;
  width: 40%;
}

.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}

.headind_srch {
  padding: 10px 29px 10px 20px;
  overflow: hidden;
  border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
  color: #ff5722;
  font-size: 21px;
  margin: auto;
}

.srch_bar input {
  border: 1px solid #cdcdcd;
  border-width: 0 0 1px 0;
  width: 80%;
  padding: 2px 0 4px 6px;
  background: none;
}

.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}

.srch_bar .input-group-addon {
  margin: 0 0 0 -27px;
}

.chat_ib h5 {
  font-size: 15px;
  color: #464646;
  margin: 0 0 8px 0;
}

.chat_ib h5 span {
  font-size: 13px;
  float: right;
}

.chat_ib p {
  font-size: 14px;
  color: #989898;
  margin: auto;
}

.chat_img {
  float: left;
  width: 11%;
}

.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people {
  overflow: hidden;
  clear: both;
}

.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}

.inbox_chat {
  height: 550px;
  overflow-y: scroll;
}

.active_chat {
  background: #ebebeb;
}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}

.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
}

.received_with_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
  overflow-wrap: break-word;
}

.time_date {
  color: #747474;
  display: flex;
  justify-content: space-between;
  font-size: 12px;
  margin-top: 8px;
}

.received_with_msg {
  width: 57%;
}

.messages {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

.sent_msg p {
  background: #ff5722 none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0;
  color: #fff;
  padding: 5px 10px 5px 12px;
  width: 100%;
  overflow-wrap: break-word;
  white-space: pre-wrap;
}

.outgoing_msg {
  overflow: hidden;
  /* margin: 26px 0 26px; */
  padding-bottom: 2rem;
}

.sent_msg {
  float: right;
  width: 46%;
}

.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {
  /* border-top: 1px solid #c4c4c4; */
  /* position: relative; */
  padding-top: 2rem;
}

.msg_send_btn {
  background: #ff5722 none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}

.messaging {
  padding: 0 0 50px 0;
}

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: '';
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

input:checked + .slider {
  background-color: #4dd100;
}

input:focus + .slider {
  box-shadow: 0 0 1px #4dd100;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

/* .msg_history {
  height: 500px;
} */
</style>
