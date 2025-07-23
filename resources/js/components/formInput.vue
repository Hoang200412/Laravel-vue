<template>
    <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" :for="idInput">{{ nameLabel }}</label>
        <input :type="typeInput" :name="nameInput" :id="idInput" class="form-control form-control-lg"
            :autocomplete="autocomplete" :placeholder="placeholder" :value="value"
            @input="$emit('update:value', $event.target.value)" />
        <span class="text-danger">{{ errorMessage }}</span>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { errorMessages } from 'vue/compiler-sfc';

    defineProps({
        nameInput: {
            type: String,
            default: ''
        },
        idInput: {
            type: String,
            default: ''
        },
        typeInput: {
            type: String,
            default: 'text'
        },
        nameLabel: {
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
            type: String,
            default: ''
        },
        errorMessage: {
            type: String,
            default: ''
        }
       
    });
</script>