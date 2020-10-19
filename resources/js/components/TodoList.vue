<template>
    <div>
        <div class="card mb-2">
            <div class="card-body">
                <todo-add
                    :categories="categories"
                    :null-category="nullCategory"
                    :validation-errors="todoAddErrors"
                    @add-todo="addTodo"
                ></todo-add>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <template v-if="todosList.length">
                    <div class="row">
                        <div class="col">
                            <todo-filter
                                :categories="categories"
                                :null-category="nullCategory"
                                :all-category="allCategory"
                                :selected="allCategory"
                                @filter-todo="filterTodo"
                            ></todo-filter>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Your todos
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <TodoListItem
                                v-for="todo in todosList"
                                :key="todo.id"
                                :todo="todo"
                                @remove-todo="removeTodo"
                            />
                        </div>
                    </div>
                </template>
                <p v-else>
                    You are awesome no todo's left.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import TodoAdd from './TodoAdd.vue';
    import TodoFilter from './TodoFilter.vue';
    import TodoListItem from './TodoListItem.vue';

    const nullCategory = {id: 0};
    const allCategory = {id: 'all'};

    export default {
        components: {
            TodoAdd, TodoFilter, TodoListItem
        },
        data() {
            return {
                nullCategory: nullCategory,
                allCategory: allCategory,
                categories: [],
                todosList: [],
                todoFilter: {
                    categoryId: allCategory.id
                },
                todoAddErrors: {}
            };
        },
        methods: {
            getTodos() {
                axios.get('api/todos', {
                    params: {
                        category: this.todoFilter.categoryId
                    }
                })
                    .then(res => {
                        this.todosList = res.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            addTodo(data) {
                axios.post('api/todos', data)
                    .then(res => {
                        this.todosList.push(res.data);
                        this.todoAddErrors = {};
                    })
                    .catch(error => {
                        console.error(error);
                        if (error.response.status == 422){
                            this.todoAddErrors = error.response.data.errors;
                        }
                    });
            },
            removeTodo(id) {
                axios.delete(`api/todos/${id}`)
                    .then(res => {
                        this.todosList = this.todosList.filter(todo => {
                            return todo.id !== id
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            filterTodo(filter) {
                this.todoFilter = filter;
                this.getTodos();
            }
        },
        created() {
            axios.get('api/categories', {})
                .then(res => {
                    this.categories = res.data.data;
                })
                .catch(error => {
                    console.error(error);
                });
            this.getTodos();
        }
    }
</script>
