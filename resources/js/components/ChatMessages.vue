<template>
    <ul class="p-8 h-full overflow-y-scroll space-y-2">
        <li class="" v-for="message in messages" :key="message.id">
            <div :class="['flex', message.recipient_id !== recipient.id ? 'justify-start' : 'justify-end']">
                <div class="bg-white p-4 rounded-lg">
                    <!-- <div :class="['', message.recipient_id !== recipient_id ? 'text-left' : 'text-right']">
                        <div>
                        <img :src="[ user.image ]" alt="">
                        </div>
                    </div> -->
                    <p>
                        {{ message.message }}
                    </p>
                    <p class="text-sm text-gray-500">{{ message.created_at }}</p>
                </div>
            </div>
        </li>
    </ul>
</template>
<script>
export default {
    props: ["messages", "recipient", "user"],
};
</script>
