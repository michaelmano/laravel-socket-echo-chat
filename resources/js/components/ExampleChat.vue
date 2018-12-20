<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default mb-4">
                    <div class="card-header">Messages</div>
                    <div class="px-2 py-1">
                        <p v-for="(message, index) in messages" :key="index">{{ message }}</p>
                    </div>
                </div>
                <div class="card card-default">
                    <input v-model="text">
                    <button @click="postMessage" :disabled="!contentExists">submit</button>
                </div>
            </div>
        </div>
    </div>
 </template>

  <script>
 export default {
         data() {
             return {
                 text: '',
                 messages: []
             }
         },
         computed: {
             contentExists() {
                 return this.text.length > 0;
             }
         },
         methods: {
             postMessage() {
                 axios.post('/post', {message: this.text}).then(({data}) => {
                     this.messages.push(this.text);
                     this.text = '';
                 });
             },
             addItem() {
                 axios.post('/add-item');
             }
         },
         created() {
             Echo.channel('chat').listen('ChatMessage', ({message}) => {
                 this.messages.push(message);
             });
         }
 }
 </script>
