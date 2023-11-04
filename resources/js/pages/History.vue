<script setup>
import BalanceOperations from "@/components/BalanceOperations/Main.vue"
</script>

<template>
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">История операций по балансу</div>

                    <div class="card-body">
                        <BalanceOperations />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>

</style>
