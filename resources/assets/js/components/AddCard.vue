<template>
    <div class="col-sm-3">
        <input type="text" class="form-control" placeholder="Add a list..." v-on:keyup.enter="newCard" v-model="name" />
    </div>
</template>

<style>
.form-control {
    background-color: rgba(0, 0, 0, 0.12);
    border: 0;
    color: #fff;
}

.form-control:hover {
    background-color: rgba(0, 0, 0, 0.2);
}
</style>

<script>
import axios from 'axios';

export default {
    props: ['boardId'],

    data() {
        return {
            name: ''
        }
    },

    methods: {
        newCard() {

            const data = {
                'name': this.name,
                'board_id': this.boardId
            };

            axios.post('/card/', data)
                 .then((response) => {
                    this.name = '';
                    this.$emit('new-card', response.data.data);
                 });

        }
    }
}
</script>
