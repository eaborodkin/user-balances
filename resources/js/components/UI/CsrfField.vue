<script setup>
const csrf = document.head.querySelector('meta[name="csrf-token"]').content
</script>

<template>
    <input type="hidden" name="_token" :value="csrf">
</template>

<style scoped>

</style>
