<template>
    <div class="row">
        <draggable v-model="cards">
            <card v-for="(card, index) in cards" :key="card.id" :id="card.id"></card>
        </draggable>
        <add-card :boardId="id"></add-card>
    </div>

</template>

<script>
import Card from './Card.vue';
import AddCard from './AddCard.vue';
import draggable from 'vuedraggable';

export default {
    props: ['id'],

    components: { Card, AddCard, draggable },

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
                    this.name  = response.data.data.name;
                    this.cards = response.data.data.cards;
                 });
        }
    }
}
</script>
