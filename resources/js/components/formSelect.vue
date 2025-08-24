<template>
    <div data-mdb-input-init class="form-outline mb-3">
        <label for="form-select">{{ label }}</label>
        <select class="form-select form-select-md mt-2 " aria-label="Large select example"
            @change="$emit('update:value', $event.target.value)" :value="value">
            <option v-if="!value" value="" disabled selected>{{ placeholder }}</option>
            <option v-for="value in datas" :value="value.id" :key="value.id">{{ value.name }}</option>
        </select>
        <span class="text-danger">{{ errorMessage }}</span>
    </div>
</template>

<script setup>
defineProps({
    placeholder: {
        type: String,
        default: ''
    },
    datas: {
        type: Array,
        default: () => []
    },
    label: {
        type: String,
        default: ''
    },
    value: {
        type: [String, Number],
        default: ''
    },
    errorMessage: {
        type: String,
        default: ''
    }
})

</script>