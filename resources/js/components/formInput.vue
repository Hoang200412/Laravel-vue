<template>
    <div data-mdb-input-init class="form-outline mb-3">
        <label class="form-label" :for="id">{{ label }}</label>
        <input :type="type" :name="name" :id="id" class="form-control" :class="size"
            :autocomplete="autocomplete" :placeholder="placeholder" :value="value"
            @input="$emit('update:value', $event.target.value)" :disabled="disabled"/>
        <span class="text-danger">{{ errorMessage }}</span>
    </div>
</template>

<script setup>

    defineProps({
        name: {
            type: String,
            default: ''
        },
        id: {
            type: String,
            default: ''
        },
        type: {
            type: String,
            default: 'text'
        },
        label: {
            type: String,
            default: ''
        },
        autocomplete: {
            type: String,
            default: 'off'
        },
        placeholder: {
            type: String,
            default: 'nhập thông tin'
        },
        value: {
            type: [String, Number],
            default: ''
        },
        errorMessage: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'form-control-lg' // 'sm', 'md', 'lg'
        },
        disabled: {
            type: Boolean,
            default: false
        }

    });
</script>