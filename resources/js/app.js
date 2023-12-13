/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

import ExampleComponent from './components/ExampleComponent.vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
    data() {
        return {
            messages: []
        }
    },
    created() {
        const recipientId = window.recipientId;
        console.log('Time to fetch...');

        this.fetchMessages(recipientId);
        window.Echo.private('chat')
            .listen('MessageSent', (e) => {
                console.log('PULLED!');
                this.messages.push({
                    message: e.message.message,
                    sender: e.sender,
                    recipient: e.recipient
                });
            });
    },
    methods: {
        fetchMessages(recipientId) {
            /* requete GET vers la méthode fetchMessages($recipient_id) du controlleur.
             * retourne les messages envoyés par l'utilisateur connecté à l'utilisateur 'recipientId'.
             */
            console.log(`Fetching messages for recipient: ${recipientId}`);
            const url = `/messages/${recipientId}`
            console.log(`URL: ${url}`);
            axios.get(url).then(response => {
                //Save the response in the messages array to display on the chat view
                this.messages = response.data;
                console.log(`Fetch successful. Messages:`);
                console.log(this.messages);
            });
        },
        addMessage(message) {
            //Pushes it to the messages array
            console.log('Adding a message: ');
            console.log(message);
            console.log('End of message.');
            this.messages.push(message);
            console.log('pushed, messages is now:');
            console.log(this.messages);
            //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        },
        dismissAlert(){
            const alert = document.getElementById("alert-3");
            alert.style.display = 'none';
        },
    }
});

app.component('example-component', ExampleComponent);
app.component('chat-messages', ChatMessages);
app.component('chat-form', ChatForm);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
