<template>
  <div v-if="notification" class="alert alert-warning alert-dismissible fade show fixed-top m-3 shadow-lg" role="alert" style="z-index: 1050; width: auto; max-width: 400px; left: auto;">
    <strong>Новая статья!</strong> {{ notification.name }}
    <button type="button" class="btn-close" @click="notification = null" aria-label="Close"></button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const notification = ref(null);

onMounted(() => {
  window.Echo.channel('test')
    .listen('NewArticleEvent', (e) => {
      console.log('Real-time event received:', e);
      notification.value = e.article;
      
      // Авто-скрытие через 10 секунд
      setTimeout(() => {
        notification.value = null;
      }, 10000);
    });
});
</script>
