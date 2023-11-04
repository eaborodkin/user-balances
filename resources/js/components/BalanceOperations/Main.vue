<script setup>
import {useBalanceOperations} from '@/store/useBalanceOperations.js'
import {onBeforeUnmount, onMounted} from "vue"
import {storeToRefs} from "pinia"
import OrderBtn from "@/components/UI/OrderBtn.vue"
import SearchField from "@/components/UI/SearchField.vue"
import Pagination from "@/components/BalanceOperations/Pagination.vue"

const props = defineProps({
    limit: {
        type: Number,
        default: null,
    },
    refreshTime: {
        type: Number,
        default: null,
    },
})

const balanceOperations = useBalanceOperations()

const {operations, limit} = storeToRefs(balanceOperations)

limit.value = props.limit

const {updateOperations} = balanceOperations

onMounted(() => {
    updateOperations()
    if (props.refreshTime !== null) {
        const updateTimeInterval = setInterval(
            updateOperations,
            props.refreshTime
        )

        onBeforeUnmount(() => {
            clearInterval(updateTimeInterval);
        });
    }
})
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="align-middle">
                            <span class="d-flex h-100 justify-content-between align-items-center">
                                Дата
                                <OrderBtn/>
                            </span>
                        </th>
                        <th class="align-middle">
                            <span class="d-flex h-100 justify-content-between align-items-center">
                                Описание
                                <SearchField class="input-group input-group-sm ms-5" />
                            </span>
                        </th>
                        <th class="align-middle">
                            <span class="d-flex h-100 align-items-center">
                                Сумма
                            </span>
                        </th>
                    </tr>
                    </thead>
                    <tbody v-if="operations.length > 0">
                    <tr v-for="operation in operations" :key="operation.id">
                        <td>{{ operation.date }}</td>
                        <td>{{ operation.description }}</td>
                        <td>{{ operation.value }}</td>
                    </tr>
                    </tbody>
                    <tbody v-else>
                    <tr>
                        <td colspan="3">
                            <div class="col-12">
                                <i>Операции отсутствуют!</i>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <Pagination v-if="limit === null" />
            </div>

        </div>
    </div>
</template>

<style scoped>

</style>
