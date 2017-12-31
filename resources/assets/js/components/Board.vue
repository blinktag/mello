<template>
    <div class="row">
        <div v-for="(list, index) in lists">
            <list :id="list.id"></list>
        </div>
    </div>

</template>

<script>
import List from './List.vue';

export default {
    props: ['id'],

    components: { List },

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
