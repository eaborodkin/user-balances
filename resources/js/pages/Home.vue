<script setup>
import BalanceOperations from "@/components/BalanceOperations/Main.vue"
import UserBalance from "@/components/UserBalance.vue"

const props = defineProps({
    refreshTime: {
        type: Number,
        default: 30000,
    },
})
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Информация о Вашем балансе</div>

                    <div class="card-body">
                        <UserBalance :refreshTime="refreshTime" />
                        <BalanceOperations :limit="5" :refreshTime="refreshTime" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
