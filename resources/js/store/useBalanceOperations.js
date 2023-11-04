import {ref, computed, watch} from "vue"
import {defineStore} from "pinia"
import {useUserAuth} from "@/store/useUserAuth.js"

export const useBalanceOperations = defineStore('balanceOperations', () => {
    const rawOperations = ref([])
    const limit = ref(null)
    const pagination = ref(null)
    const orderDesc = ref(true)
    const search = ref('')
    const page = ref(1)

    const requestParams = computed(() => {
        return {
            order: orderDesc.value ? 'desc' : 'asc',
            search: search.value,
            page: page.value,
        }
    })

    watch(requestParams, (newVal) => {
        updateOperations()
    })

    const {processServerResponse} = useUserAuth()

    const operations = computed(() => {
        return rawOperations.value.filter((value, index) => (limit.value !== null) ? (index < limit.value) : true)
    })

    const updateOperations = async (url = '/api/user/balance/history?page=1') => {
        const {data, status} = await axios.get(url, {
            params: requestParams.value,
        })

        processServerResponse(status)
        rawOperations.value = data.data
        pagination.value = preparePagination(data.meta)
        if (rawOperations.value.length === 0 && pagination.value.current_page !== 1) {
            page.value = 1
        }
    }

    const preparePagination = (meta) => {
        meta.links = meta.links.map(link => {
            if (null !== link.url) {
                const url = new URL(link.url)
                link.url = url.searchParams.get('page')
            }
            return link
        })
        return meta
    }

    return {
        rawOperations,
        operations,
        updateOperations,
        limit,
        pagination,
        orderDesc,
        search,
        page,
        requestParams,
    }
})
