<script setup>
import LayoutAuth from "../../Layouts/Auth.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";

const form = reactive({
    email: "",
    password: "",
    remember: "",
});

const { errors, session } = defineProps({
    errors: Object,
    session: Object,
});

const submit = () => {
    Inertia.post("/login", {
        email: form.email,
        password: form.password,
    });
};
</script>

<template>
    <Head>
        <title>Login - Monitoring STB</title>
    </Head>

    <LayoutAuth>
        <div
            class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
        >
            <div class="d-flex justify-content-center py-4">
                <Link href="/" class="logo d-flex align-items-center w-auto">
                    <img src="/admin/img/logo.png" alt="" />
                    <span class="d-none d-lg-block">Fuboru</span>
                </Link>
            </div>
            <!-- End Logo -->

            <div class="card mb-3">
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                        <p class="text-center small">Monitoring STB</p>
                    </div>

                    <form class="row g-3" @submit.prevent="submit">
                        <div class="col-12">
                            <label for="yourUsername" class="form-label"
                                >Username</label
                            >
                            <div class="input-group">
                                <span
                                    class="input-group-text"
                                    id="inputGroupPrepend"
                                    >@</span
                                >
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="form.email"
                                    placeholder="Email"
                                    :class="{ 'is-invalid': errors.email }"
                                />
                                <div
                                    v-if="errors.email"
                                    class="invalid-feedback"
                                >
                                    {{ errors.email }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label"
                                >Password</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                v-model="form.password"
                                placeholder="Password"
                                :class="{ 'is-invalid': errors.password }"
                            />
                            <div
                                v-if="errors.password"
                                class="invalid-feedback"
                            >
                                {{ errors.password }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    v-model="form.remember"
                                    value="true"
                                    id="rememberMe"
                                />
                                <label class="form-check-label" for="rememberMe"
                                    >Remember me</label
                                >
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="credits">
                Dibuat oleh
                <a
                    href="https://fuboru.co.id/"
                    target="_blank"
                    ref="nofollow noopener"
                    >Fuboru Indonesia</a
                >
            </div>
        </div>
    </LayoutAuth>
</template>
