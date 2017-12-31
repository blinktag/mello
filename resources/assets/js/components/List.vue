<template>
    <div class="col-sm-3">
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
            <div class="panel-footer">
                <input type="text" class="form-control input-sm" placeholder="Add new item" v-on:keyup.enter="addItem" v-model="new_item" />
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    props: ['id'],

    components: { draggable },

    data() {
        return {
            new_item: '',
            list_id: 0,
            name: 'some tasks',
            items: [
                {id: 1, name: 'Mark'},
                {id: 2, name: 'Smith'},
            ]
        }
    },

    methods: {
        addItem() {
            const last_id = this.items[this.items.length-1].id + 1;
            this.items.push({id: last_id, name: this.new_item});
            this.new_item = '';
        }
    }
}
</script>
