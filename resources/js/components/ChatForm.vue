<template>
  <div class="p-4 space-x-4 rounded-lg">
    <input
      id="btn-input"
      type="text"
      name="message"
      class="w-5/6 resize-none border-x-0 border-t-0 border-gray-500 px-0 align-top sm:text-sm bg-inherit"
      placeholder="Tapez votre message..."
      v-model="newMessage"
      @keyup.enter="sendMessage"
    />
    <span class="input-group-btn">
      <button class="btn-primary rounded-full" id="btn-chat" @click="sendMessage">
        <i class="ri-send-plane-2-line"></i>
      </button>
    </span>
  </div>
</template>
<script>
export default {
  props: ["sender", "recipient"],
  data() {
    return {
      newMessage: "",
    };
  },
  methods: {
    sendMessage() {
      this.$emit("messagesent", {
        sender: this.sender,
        recipient: this.recipient,
        message: this.newMessage,

        user_id: this.sender.id,
        recipient_id: this.recipient.id,
        created_at: 'à l\'instant'
      });
      //Clear the input
      this.newMessage = "";
    },
  },
};
</script>
