<template>
    <div class="row">
        <draggable v-model="lists">
            <list v-for="(list, index) in lists" :key="list.id" :id="list.id"></list>
        </draggable>
    </div>

</template>

<script>
import List from './List.vue';
import draggable from 'vuedraggable';

export default {
    props: ['id'],

    components: { List, draggable },

    data() {
        return {
            user_id: '',
            name: '',
            lists: [
                {id: 1, name: 'Marks Tasks'},
                {id: 2, name: 'Someones elses tasks'}
            ]
        }
    },

    methods: {
        fetch() {
            axios.get("/board/" + this.id)
                 .then((response) => {
                    this.data = response.data;
                 });
        }
    }
}
</script>
