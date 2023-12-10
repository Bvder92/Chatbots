<template>
    <ul class="chat">
        <li class="left " v-for="message in messages" :key="message.id">
            <div class="clearfix">
                <div class="flex justify-start">
                    <strong>
                        {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>
<script>
export default {
    props: ["messages"],
};
</script>
