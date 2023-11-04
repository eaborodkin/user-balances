<script setup>
import {useBalanceOperations} from "@/store/useBalanceOperations.js"
import {storeToRefs} from "pinia"

const balanceOperations = useBalanceOperations()
const {search} = storeToRefs(balanceOperations)
</script>

<template>
<span>
    <input type="text" v-model.lazy="search" class="form-control" placeholder="поиск..." />
</span>
</template>

<style scoped>

</style>
