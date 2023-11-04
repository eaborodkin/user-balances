<script setup>
import {mdiOrderNumericAscending, mdiOrderNumericDescending} from '@mdi/js';
import {useBalanceOperations} from "@/store/useBalanceOperations.js"
import {storeToRefs} from "pinia"
import {computed} from "vue"
import SvgIcon from "@jamescoyle/vue-icon"

const balanceOperations = useBalanceOperations()
const {updateOperations} = balanceOperations
const {orderDesc} = storeToRefs(balanceOperations)

const order = computed(() => (orderDesc.value)?mdiOrderNumericDescending:mdiOrderNumericAscending)

const toogleOrder = ()=>{
    orderDesc.value = !orderDesc.value
}
</script>

<template>
    <button @click.prevent="toogleOrder" type="button" class="btn rounded-circle p-1">
        <svg-icon type="mdi" :path="order" size="22"></svg-icon>
    </button>
</template>

<style scoped>

</style>
