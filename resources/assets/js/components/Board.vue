<template>
    <div>
        <div v-for="(list, index) in lists">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ list.name }}
                </div>
                <div  class="panel-body">
                    items go here
                </div>
            </div>
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
            lists: []
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
