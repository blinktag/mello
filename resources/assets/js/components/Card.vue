<template>
    <div class="col-sm-3" v-on:mouseover="mouseOver" v-on:mouseout="mouseOut">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ name }}
            </div>
            <div class="panel-body">
                <ul class="list-group mb0">
                    <draggable v-model="items">
                        <li class="list-group-item" v-for="item in items" :key="item.id">
                            {{item.name}}
                        </li>
                    </draggable>
                </ul>
            </div>
            <div class="panel-footer" v-if="show_add == true">
                <input type="text" class="form-control input-sm" placeholder="Add new item" v-on:keyup.enter="addItem" v-model="new_item" />
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
import axios from 'axios';

export default {
    props: ['id'],

    components: { draggable },

    data() {
        return {
            new_item: '',
            show_add: false,
            name: '',
            items: []
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            axios.get("/card/" + this.id)
                 .then((response) => {
                    this.name = response.data.name;
                    this.items = response.data.items;
                 });
        },

        addItem() {
            const last_id = this.items[this.items.length-1].id + 1;
            this.items.push({id: last_id, name: this.new_item});
            this.new_item = '';
        },

        saveState() {
            // use items index for view order
        },

        mouseOver() {
            this.show_add = true;
        },
        mouseOut() {
            this.show_add = false;
        }
    }
}
</script>
