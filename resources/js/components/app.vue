<script setup>
import { ref, provide } from 'vue';
import DefaultLayout from './Layouts/DefaultLayout.vue';

const user = ref(null);
provide('user', user);

</script>
<template>
  <DefaultLayout>
    <router-view />
  </DefaultLayout>
</template>