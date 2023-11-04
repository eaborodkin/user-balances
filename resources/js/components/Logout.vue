<script setup>
import router from "@/router.js"
import {useUserAuth} from "@/store/useUserAuth.js"

const {logout} = useUserAuth()
</script>

<template>
<button @click.prevent="logout">
    <slot />
</button>
</template>

<style scoped>

</style>
