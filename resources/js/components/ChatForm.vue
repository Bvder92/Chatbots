<template>
  <div class="p-4 rounded-lg">
    <input
      id="btn-input"
      type="text"
      name="message"
      class=""
      placeholder="Type your message here..."
      v-model="newMessage"
      @keyup.enter="sendMessage"
    />
    <span class="input-group-btn">
      <button class="btn-primary" id="btn-chat" @click="sendMessage">
        Send
      </button>
    </span>
  </div>
</template>
<script>
export default {
  //Takes the "user" props from <chat-form> … :user="{{ Auth::user() }}"></chat-form> in the parent chat.blade.php.
  props: ["user", "recipient"],
  data() {
    return {
      newMessage: "",
    };
  },
  methods: {
    sendMessage() {
      //Emit a "messagesent" event including the user who sent the message along with the message content
      this.$emit("messagesent", {
        user: this.user,
        recipient: this.recipient,
        //newMessage is bound to the earlier "btn-input" input field
        message: this.newMessage,
      });
        console.log('***messagesent event***');
        console.log(this.user);
        console.log(this.recipient);
        console.log(this.message);
        console.log('*** end ***');
      //Clear the input
      this.newMessage = "";
    },
  },
};
</script>
