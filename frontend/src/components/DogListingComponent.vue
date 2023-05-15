<template>
    <div>
        <ul v-for="dog in dogs">
            <li>Name: {{ dog.name }}, Data: {{ dog.data }}</li>
        </ul>
    </div>
</template>
<script setup>
import DogService from "../services/DogService.ts";
import {onMounted, ref} from 'vue'

const dogs = ref([]);

onMounted(async () => {
    dogs.value = await DogService.listDogs(import.meta.env.VITE_AUTHORIZATION_SECRET);
})
</script>
