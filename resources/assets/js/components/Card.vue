<template>
    <div class="col-sm-3" v-on:mouseover="mouseOver" v-on:mouseout="mouseOut">
        <div class="panel panel-default">
            <div class="panel-heading" @dblclick="show_title_form = true">
                <span v-if="!show_title_form">{{ name }}</span>
                <span v-if="show_title_form">
                    <input type="text" class="form-control input-sm" v-on:keyup.enter="update" v-model="name" />
                </span>
            </div>
            <div class="panel-body">
                <ul class="list-group mb0">
                    <draggable v-model="items" @change="saveState">
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
            show_title_form: false,
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
                    this.name  = response.data.data.name;
                    this.items = response.data.data.items;
                 });
        },

        addItem() {
            const data = {
                'card_id': this.id,
                'name': this.new_item
            }
            axios.post('/task/', data).then((response) => {
                let last_id = 0;
                if (this.items.length > 0) {
                    let last_id = this.items[this.items.length-1].id + 1;
                }
                this.items.push({id: response.data.data.id, name: data.name});
            });
            this.new_item = '';
        },

        saveState() {
            axios.put('/task/update-order/', {items: this.items})
                 .then((response) => {
                    //
                 });
        },

        update() {
            const data = {
                id: this.id,
                name: this.name
            }
            axios.put('/card/' + this.id, data)
                 .then((response) => {
                    this.name = response.data.data.name;
                 });
             this.show_title_form = false;
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
