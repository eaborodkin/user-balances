<script setup>
import {useUserAuth} from "@/store/useUserAuth.js"
import {storeToRefs} from "pinia"
import CsrfField from "@/components/UI/CsrfField.vue"

const userAuth = useUserAuth()
const {signIn} = userAuth
const {email, password} = storeToRefs(userAuth)

</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit.prevent="signIn">
                            <CsrfField />

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                                <div class="col-md-6">
                                    <input v-model="email" type="email" class="form-control"
                                           name="email" required autocomplete="email" autofocus>

                                    <!--                                @error('email')-->
                                    <!--                                <span class="invalid-feedback" role="alert">-->
                                    <!--                                        <strong>{{ $message }}</strong>-->
                                    <!--                                    </span>-->
                                    <!--                                @enderror-->
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input v-model="password" type="password"
                                           class="form-control" name="password"
                                           required autocomplete="current-password">

                                    <!--                                @error('password')-->
                                    <!--                                <span class="invalid-feedback" role="alert">-->
                                    <!--                                        <strong>{{ $message }}</strong>-->
                                    <!--                                    </span>-->
                                    <!--                                @enderror-->
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
