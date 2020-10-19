<template>
    <div class="row">
        <div class="col">
            <label for="categories">Filter by category</label>
            <select
                id="categories"
                name="categories"
                class="form-control mb-2 mr-sm-2"
                v-model="selectedCategory"
                @change="$emit('filter-todo', {categoryId: selectedCategory.id})"
            >
                <option :value="allCategory">All</option>option>
                <option :value="nullCategory">-</option>option>
                <option v-for="category in categories" :value="category">{{category.name}}</option>
            </select>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            categories: {
                type: Array,
                required: true
            },
            nullCategory: {
                type: Object,
                required: true
            },
            allCategory: {
                type: Object,
                required: true
            },
            selected: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedCategory: this.selected,
            }
        },
        methods: {
            applyFilter() {
                this.$emit(
                    'filterTodo',
                    {
                        categoryId: this.selectedCategory.id
                    }
                );
            }
        }
    }
</script>
