<script setup>
import { ref, provide, onMounted } from 'vue';
import DefaultLayout from './Layouts/DefaultLayout.vue';

const user = ref(null);
provide('user', user);

onMounted(async () => {
  getUser()
})

const getUser = async () => {
  let response = await axios.get('api/user')
  user.value = response.data
}
</script>
<template>
  <DefaultLayout>
    <router-view />
  </DefaultLayout>
</template>