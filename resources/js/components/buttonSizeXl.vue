<template>
    <div class="pt-1 mb-4 d-flex flex-column">
        <button class="btn btn-lg" :type="typeButton" v-bind="$attrs">{{ name }}</button>
    </div>
</template>

<script setup>
    defineProps({
        name: {
            type : String,
            default: 'Click'
        },
        typeButton: {
            type: String,
            default: 'button'
        }
    });

    defineOptions({
        inheritAttrs: false
    });
</script>