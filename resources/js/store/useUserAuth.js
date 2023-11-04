import {computed, onMounted, reactive, ref, toRefs} from "vue"
import {defineStore} from "pinia"
import router from "@/router.js"
import _ from "lodash"

export const useUserAuth = defineStore('userAuth', () => {
    const tokenName = 'x_xsrf_token'

    const defaultOptions = {
        headers: {
            'Accept': 'application/json'
        },
    }

    const userAuthToken = ref(null)
    // userAuthToken.value = '1234567890'
    const isAuthorized = computed(() => userAuthToken.value !== null)

    const email = ref('')
    const password = ref('')

    onMounted(() => {
        checkToken()
        getXXsrfToken()
    })

    const signIn = () => {
        axios(_.merge(defaultOptions, {
            method: 'get',
            url: '/sanctum/csrf-cookie',
        }))
            .then(response => {
                processServerResponse(response)
                axios(_.merge(defaultOptions, {
                    method: 'post',
                    url: '/api/login',
                    data: {
                        email: email.value,
                        password: password.value,
                    },
                }))
                    .then(res => {
                        processServerResponse(res)
                        clearEmailPassword()
                        router.push({name: 'home'})
                    })
            });
    }

    const getXXsrfToken = () => {
        userAuthToken.value = localStorage.getItem(tokenName)
    }

    const setXXsrfToken = (token) => {
        eraseXXsrfToken()
        localStorage.setItem(tokenName, token)
        userAuthToken.value = token
    }
    const eraseXXsrfToken = () => {
        const token = localStorage.getItem(tokenName)
        if (token) {
            localStorage.removeItem(tokenName)
        }
        userAuthToken.value = null
    }

    const checkToken = () => {
        axios(_.merge(defaultOptions, {
            method: 'get',
            url: '/api/check-token',
        }))
            .then(res => {
                processServerResponse(res)
            })
    }

    const logout = () => {
        axios(_.merge(defaultOptions, {
            method: 'post',
            url: '/api/logout',
        }))
            .then(res => {
                eraseXXsrfToken()
                router.push({name: 'login'})
            })
    }

    const clearEmailPassword = () => {
        email.value = ''
        password.value = ''
    }

    const processServerResponse = (res) => {
        const status = (res?.status !== undefined) ? res.status : res
        switch (status) {
            case 204:
                setXXsrfToken(res.config.headers['X-XSRF-TOKEN'])
                break

            case 401:
            case 419:
                eraseXXsrfToken()
                router.push({name: 'login'})
                break

            case 422:
                eraseXXsrfToken()
                clearEmailPassword()
                router.push({name: 'login'})
                break
        }
    }

    return {
        email,
        password,
        isAuthorized,
        signIn,
        logout,
        processServerResponse,
    }
})
