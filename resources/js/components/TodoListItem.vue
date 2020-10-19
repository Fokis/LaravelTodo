<template>
    <div class="card mb-2">
        <div class="card-body">
            <button type="button" class="close" aria-label="Remove" @click="$emit('remove-todo', todo.id)">
                <span aria-hidden="true">&times;</span>
            </button>
            <template v-if="todo.category">{{ todo.category}} | </template>{{ todo.description }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            todo: {
                type: Object,
                required: true
            }
        }
    }
</script>
