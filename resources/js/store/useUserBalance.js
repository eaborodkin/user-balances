import {ref} from "vue"
import {defineStore} from "pinia"
import {useUserAuth} from "@/store/useUserAuth.js"

export const useUserBalance = defineStore('userBalance', () => {
    const balance = ref(0)

    const {processServerResponse} = useUserAuth()
    const updateBalance = async () => {
        const {data, status} = await axios.get('/api/user/balance', {
            headers: {
                'Accept': 'application/json'
            },
        })

        processServerResponse(status)

        balance.value = data.data.balance
    }

    return {
        balance,
        updateBalance,
    }
})
