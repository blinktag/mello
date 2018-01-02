<template>
    <div class="col-sm-3" v-on:mouseover="mouseOver" v-on:mouseout="mouseOut">
        <div class="panel panel-default">
            <div class="panel-heading" @click="toggleTitleForm">
                <span v-if="!show_title_form">{{ name }}</span>
                <span v-if="show_title_form">
                    <input type="text" ref="titlefield" class="form-control input-sm" v-on:keyup.enter="update" v-on:keyup.esc="toggleTitleForm" v-model="name" />
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

<style>
.panel {
    width: 100%;
    height: fit-content;
}

.list-group-item {
    padding: 5px 15px;
}

.panel-heading {
    color: #333;
    background-color: #e2e4e6 !important;
    font-weight: bold;
    border: 0;
}

.panel-default {
    background-color: #e2e4e6;
}

.panel-body {
    padding-top: 0;
}

.list-group-item {
    margin: 2px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.panel-footer {
    border-top: 0;
}
</style>

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
        },

        toggleTitleForm() {

            this.show_title_form = !this.show_title_form;

            // Use nextTick because the element might not be in the DOM yet
            this.$nextTick(() => {
                if (this.$refs.titlefield) {
                    this.$refs.titlefield.focus();
                    this.$refs.titlefield.select();
                }
            })
        }
    }
}
</script>
