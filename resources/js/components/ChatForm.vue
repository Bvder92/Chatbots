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
  props: ["sender", "recipient"],
  data() {
    return {
      newMessage: "",
    };
  },
  methods: {
    sendMessage() {
      //Emit a "messagesent" event including the user who sent the message along with the message content
      this.$emit("messagesent", {
        sender: this.sender,
        recipient: this.recipient,
        //newMessage is bound to the earlier "btn-input" input field
        message: this.newMessage,

        user_id: this.sender.id,
        recipient_id: this.recipient.id,
        created_at: 'à l\'instant'
      });
        console.log('***messagesent event***');
        console.log(this.user);
        console.log(this.recipient.id);
        console.log(this.newMessage);
        console.log('*** end ***');
      //Clear the input
      this.newMessage = "";
    },
  },
};
</script>
