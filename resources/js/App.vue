<script setup>
import {useUserAuth} from './store/useUserAuth.js'
import Logout from "@/components/Logout.vue"
import {storeToRefs} from "pinia"

const user = useUserAuth()
const {isAuthorized} = storeToRefs(user)

</script>

<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Лэйбл">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li v-if="isAuthorized" class="nav-item">
                            <router-link :to="{name:'home'}" class="nav-link">Главная</router-link>
                        </li>
                        <li v-if="isAuthorized" class="nav-item">
                            <router-link :to="{name:'history'}" class="nav-link">Операции</router-link>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <template v-if="!isAuthorized">
                            <li class="nav-item">
                                <router-link :to="{name:'login'}" class="nav-link">Войти</router-link>
                            </li>
                        </template>
                        <template v-else>
                            <li class="nav-item">
                                <Logout class="nav-link">Выйти</Logout>
                            </li>
                        </template>
<!--                        <template v-else>-->
<!--                            <li class="nav-item dropdown">-->
<!--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"-->
<!--                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>-->
<!--                                    Имя пользователя-->
<!--                                </a>-->

<!--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">-->
<!--                                    <a class="dropdown-item" href="№" @click.prevent="">Выйти</a>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </template>-->
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            <router-view/>
        </main>
    </div>
</template>

<style scoped>

</style>
