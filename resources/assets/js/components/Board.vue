<template>
    <div class="row">
        <draggable v-model="cards">
            <card v-for="(card, index) in cards" :key="card.id" :id="card.id"></card>
        </draggable>
    </div>

</template>

<script>
import Card from './Card.vue';
import draggable from 'vuedraggable';

export default {
    props: ['id'],

    components: { Card, draggable },

    data() {
        return {
            name: '',
            cards: []
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            axios.get("/board/" + this.id)
                 .then((response) => {
                    this.name = response.data.name;
                    this.cards = response.data.cards;
                 });
        }
    }
}
</script>
