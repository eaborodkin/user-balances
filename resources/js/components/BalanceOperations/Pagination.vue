<script setup>
import {useBalanceOperations} from '@/store/useBalanceOperations.js'
import {storeToRefs} from "pinia"

const balanceOperations = useBalanceOperations()

const {page, pagination} = storeToRefs(balanceOperations)
</script>

<template>
    <nav>
        <ul v-if="null !== pagination" class="pagination justify-content-end">
            <li v-for="link in pagination.links"
                :key="link.label"
                :class="{active:link.active, disabled:link.url===null || link.active}"
                class="page-item"
            >
                <a @click.prevent="page = Number(link.url)"
                   class="page-link"
                   href="#"
                   v-html="link.label"
                ></a>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
.page-link {
    color: unset;
}
</style>
