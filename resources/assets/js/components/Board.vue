<template>
    <div class="container-fluid">
            <draggable v-model="cards" class="row flex-row flex-now">
                <card v-for="(card, index) in cards" :key="card.id" :id="card.id"></card>
                <add-card :boardId="id" @new-card="cardAdded"></add-card>
            </draggable>
    </div>
</template>

<style>
.row {
    overflow-x: scroll;
}
.row > .col-sm-3 {
    display:flex;
    flex: 0 0 270px;
    max-width: 270px;
}
</style>

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
        },

        cardAdded(card) {
            this.cards.push(card);
        }
    }
}
</script>
