<!-- @format -->

<template>
  <div class="todo-sidebar" style="overflow: auto; width: auto; height: 445px;">
    <div class="portlet light">
      <div class="portlet-title">
        <div
          class="caption"
          data-toggle="collapse"
          data-target=".todo-project-list-content"
        >
          <br />
          <span
            class="caption-subject text-orange bold uppercase"
            style="float: right;"
          >
            {{
              contacts.length > 1
                ? `${contacts.length} Customers`
                : `${contacts.length} Customer`
            }}
          </span>
          <span
            class="caption-helper visible-sm-inline-block visible-xs-inline-block"
            >click to view project list</span
          >
        </div>
      </div>
      <br />
      <div class="nano-content" tabindex="0" style="right: -17px;">
        <div class="chat-user-list panel">
          <router-link
            v-for="(contact, contactIndex) in contacts"
            :key="contactIndex"
            :to="{
              name: 'contactChat',
              params: { contactData: serializedCustomerData(contact) }
            }"
            style="padding: 5px 12px;"
          >
            <a href="javascript:;" class="chat-unread">
              <div class="media-left">
                <img
                  src="/assets/img/profile-photos/1.png"
                  class="img-sm img-circle"
                  v-if="
                    contact.order_by === 'Backend' ||
                      contact.order_by === 'Customer'
                  "
                />
                <img
                  src="/assets/img/profile-photos/3.png"
                  class="img-sm img-circle"
                  v-else
                />
                <i
                  class="badge badge-success badge-stat badge-icon pull-left"
                  style="font-size: 1.5em"
                  v-if="
                    (contact.status === 'active' &&
                      contact.sender_id === user_id) ||
                      (contact.status === 'active' &&
                        contact.sender_id != user_id)
                  "
                ></i>
                <i
                  class="badge badge-danger badge-stat badge-icon pull-left"
                  style="font-size: 1.5em"
                  v-else
                ></i>
              </div>
              <div class="media-body">
                <div class="comment-head">
                  <p
                    class="media-heading box-inline text-main text-bold"
                    style="font-size: 12px;"
                  >
                    {{ `${contact.account_name}` }}
                  </p>
                  <p class="text-muted">
                    <!-- <span
                      class="label label-success mar-rgt"
                      v-if="
                        (contact.status === 'active' &&
                          contact.sender_id === user_id) ||
                          (contact.status === 'active' &&
                            contact.sender_id != user_id)
                      "
                      >Active
                    </span>

                    <span v-else class="label label-danger mar-rgt">
                      Closed
                    </span> -->

                    <span class="text-sm text-muted">
                      {{
                        contact.hasOwnProperty('last_message') &&
                          contact.last_message.msg_datetime | calendar
                      }}
                    </span>
                  </p>
                </div>
              </div>
            </a>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    contacts: {
      type: Array,
      required: true
    },
    userInfo: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      user_id: null
    }
  },
  methods: {
    serializedCustomerData({
      id,
      account_name,
      account_code,
      ref_no,
      status,
      cus_mobile_number,
      disabled_by
    }) {
      return btoa(
        JSON.stringify({
          id,
          contact: `${account_name}`,
          account_code: `${account_code}`,
          ref_no: `${ref_no}`,
          status: `${status}`,
          mobile: `${cus_mobile_number}`,
          disabled_by: disabled_by,
          type: 'Customer'
        })
      )
    }
  },
  mounted() {
    this.user_id = this.$root.authUser.id
  }
}
</script>
<style scoped>
.nav-pills > li.active > a,
.nav-pills > li.active > a:focus,
.nav-pills > li.active > a:hover {
  color: #fff;
  background-color: #ff5722;
}
</style>
