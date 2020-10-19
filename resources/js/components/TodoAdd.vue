<template>
    <div>
        <div class="form-group">
            <label for="categories">Category</label>
            <select id="categories" name="categories" class="form-control" v-model="selectedCategory">
                <option :value="nullCategory">-</option>option>
                <option v-for="category in categories" :value="category">{{category.name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Todo</label>
            <input type="text" id="description" name="description" class="form-control" placeholder="Todo" v-model="description">
        </div>
        <div v-if="errors.length > 0">
            <ul class="alert alert-danger">
                <li v-for="error in errors">{{error}}</li>
            </ul>
        </div>
        <button class="btn btn-primary" @click="addTodo">Add</button>
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
            validationErrors: {
                type: Object,
                default: null
            }
        },
        data () {
            return {
                description: '',
                selectedCategory: this.nullCategory,
            }
        },
        computed: {
            errors() {
                return Object.values(this.validationErrors).flat();
            }
        },
        methods: {
            addTodo () {
                this.$emit(
                    'add-todo',
                    {
                        description: this.description,
                        categoryId: this.selectedCategory.id
                    }
                );
            }
        }
    }
</script>
