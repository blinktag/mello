<template>
    <div class="col-sm-3">
        <input type="text" class="form-control" placeholder="Add a list..." v-on:keyup.enter="newCard" v-model="name" />
    </div>
</template>

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
                    // somehow talk to parent board.vue, vuex?
                 });

        }
    }
}
</script>
