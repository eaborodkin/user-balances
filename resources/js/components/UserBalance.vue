<script setup>
import {onBeforeUnmount, onMounted} from "vue"
import {storeToRefs} from 'pinia'
import {useUserBalance} from '@/store/useUserBalance.js'

const props = defineProps({
    refreshTime: {
        type: Number,
        default: 10000,
    },
})

const userBalance = useUserBalance()
const {balance} = storeToRefs(userBalance)
const {updateBalance} = userBalance

onMounted(() => {
    updateBalance()

    const updateTimeInterval = setInterval(
        updateBalance,
        props.refreshTime
    )

    onBeforeUnmount(() => {
        clearInterval(updateTimeInterval);
    });
})
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col-4 card-title">Текущий баланс пользователя</div>
            <div class="col-8">{{ balance }}</div>
        </div>
    </div>
</template>

<style scoped>

</style>
