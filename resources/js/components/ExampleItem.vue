<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div v-for="(item, index) in items" :key="index">
                        {{ item.name }}
                    </div>
                    <button @click="addItem">Add Item</button>
                </div>
            </div>
        </div>
    </div>
 </template>

  <script>
 export default {
         data() {
             return {
                 items: [],
             }
         },
         methods: {
             addItem() {
                 axios.post('/add-item');
             },
         },
         created() {
            Echo.private('item-added.1').listen('ItemAdded', (data) => {
                this.items.push(data.item)
            });
         }
 }
 </script>
