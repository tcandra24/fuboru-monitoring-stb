<script setup>
import LayoutAuth from "../../Layouts/Auth.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";

const form = reactive({
    name: "",
    kode_pelanggan: "",
    kode_area: "",
    email: "",
    password: "",
    remember: "",
});

const { errors, session, customers, branches } = defineProps({
    errors: Object,
    session: Object,
    customers: Object,
    branches: Object,
});

const submit = () => {
    Inertia.post("/register", {
        name: form.name,
        kode_pelanggan: form.kode_pelanggan,
        kode_area: form.kode_area,
        email: form.email,
        password: form.password,
        password_confirmation: form.password_confirmation,
    });
};
</script>

<template>
    <Head>
        <title>Register - Monitoring STB</title>
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
                        <h5 class="card-title text-center pb-0 fs-4">
                            Register
                        </h5>
                        <p class="text-center small">Monitoring STB</p>
                    </div>

                    <form class="row g-3" @submit.prevent="submit">
                        <div class="col-12">
                            <label for="yourUsername" class="form-label"
                                >Name</label
                            >
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.name"
                                    placeholder="Name"
                                    :class="{ 'is-invalid': errors.name }"
                                />
                                <div
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                >
                                    {{ errors.name }}
                                </div>
                            </div>
                        </div>

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
                            <label for="yourUsername" class="form-label"
                                >Pelanggan</label
                            >
                            <div class="input-group">
                                <select
                                    class="form-select"
                                    id="form-element-kode-pelanggan"
                                    aria-label="Kode Pelanggan"
                                    v-model="form.kode_pelanggan"
                                    :class="{
                                        'is-invalid': errors.kode_pelanggan,
                                    }"
                                >
                                    <option selected="">Pilih Pelanggan</option>
                                    <option
                                        v-for="(customer, index) in customers"
                                        :value="customer.kode"
                                        :key="index"
                                    >
                                        {{ customer.nama }}
                                    </option>
                                </select>
                                <div
                                    v-if="errors.kode_pelanggan"
                                    class="invalid-feedback"
                                >
                                    {{ errors.kode_pelanggan }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourUsername" class="form-label"
                                >Area</label
                            >
                            <div class="input-group">
                                <select
                                    class="form-select"
                                    id="form-element-kode-pelanggan"
                                    aria-label="Kode Pelanggan"
                                    v-model="form.kode_area"
                                    :class="{
                                        'is-invalid': errors.kode_area,
                                    }"
                                >
                                    <option selected="">Pilih Area</option>
                                    <option
                                        v-for="(branch, index) in branches"
                                        :value="branch.kode"
                                        :key="index"
                                    >
                                        {{ branch.nama }}
                                    </option>
                                </select>
                                <div
                                    v-if="errors.kode_area"
                                    class="invalid-feedback"
                                >
                                    {{ errors.kode_area }}
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
                            <label for="yourPassword" class="form-label"
                                >Password Confirmation</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                v-model="form.password_confirmation"
                                placeholder="Password Confirmation"
                                :class="{
                                    'is-invalid': errors.password_confirmation,
                                }"
                            />
                            <div
                                v-if="errors.password_confirmation"
                                class="invalid-feedback"
                            >
                                {{ errors.password_confirmation }}
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">
                                Register
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
