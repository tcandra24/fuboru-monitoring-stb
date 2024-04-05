<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";

const props = defineProps({
    errors: Object,
    roles: Object,
    customers: Object,
    branches: Object,
});

const toast = useToast();

const form = reactive({
    nama: "",
    kode_pelanggan: "",
    kode_area: "",
    email: "",
    password: "",
    password_confirmation: "",
    roles: [],
});

const all_role = props.roles.map((data) => data.name);

const submit = () => {
    Inertia.post(
        "/setting/users",
        {
            nama: form.nama,
            kode_pelanggan: form.kode_pelanggan,
            kode_area: form.kode_area,
            email: form.email,
            password: form.password,
            password_confirmation: form.password_confirmation,
            roles: form.roles,
        },
        {
            onSuccess: () => {
                toast.open({
                    message: "Sukses simpan user",
                    type: "success",
                    duration: 2000,
                    position: "bottom",
                    dismissible: true,
                });
            },
        }
    );
};
</script>

<template>
    <Head>
        <title>Tambah Pengguna - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Tambah Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">
                        <Link href="/setting/users">Pengguna</Link>
                    </li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Pengguna</h5>
                            <form class="row g-3" @submit.prevent="submit">
                                <div class="col-12">
                                    <label
                                        for="form-element-nama"
                                        class="form-label"
                                        >Nama</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.nama"
                                        class="form-control"
                                        id="form-element-nama"
                                        :class="{ 'is-invalid': errors.nama }"
                                    />
                                    <div
                                        v-if="errors.nama"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.nama }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label
                                        for="form-element-kode-pelanggan"
                                        class="form-label"
                                        >Kode Pelanggan</label
                                    >
                                    <select
                                        class="form-select"
                                        id="form-element-kode-pelanggan"
                                        aria-label="Kode Pelanggan"
                                        v-model="form.kode_pelanggan"
                                        :class="{
                                            'is-invalid': errors.kode_pelanggan,
                                        }"
                                    >
                                        <option selected="">
                                            Pilih Pelanggan
                                        </option>
                                        <option
                                            v-for="(
                                                customer, index
                                            ) in props.customers"
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
                                <div class="col-6">
                                    <label
                                        for="form-element-kode-pelanggan"
                                        class="form-label"
                                        >Area</label
                                    >
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
                                            v-for="(
                                                branch, index
                                            ) in props.branches"
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
                                <div class="col-6">
                                    <label
                                        for="form-element-email"
                                        class="form-label"
                                        >Email</label
                                    >
                                    <input
                                        type="email"
                                        v-model="form.email"
                                        class="form-control"
                                        id="form-element-email"
                                        :class="{ 'is-invalid': errors.email }"
                                    />
                                    <div
                                        v-if="errors.email"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.email }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label
                                        for="form-element-roles"
                                        class="form-label"
                                        >Role</label
                                    >
                                    <Multiselect
                                        v-model="form.roles"
                                        :options="all_role"
                                        mode="tags"
                                        :class="{ 'is-invalid': errors.roles }"
                                    />
                                    <div
                                        v-if="errors.roles"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.roles }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label
                                        for="form-element-password"
                                        class="form-label"
                                        >Password</label
                                    >
                                    <input
                                        type="password"
                                        v-model="form.password"
                                        class="form-control"
                                        id="form-element-password"
                                        :class="{
                                            'is-invalid': errors.password,
                                        }"
                                    />
                                    <div
                                        v-if="errors.password"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.password }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label
                                        for="form-element-password-confirm"
                                        class="form-label"
                                        >Konfirmasi Password</label
                                    >
                                    <input
                                        type="password"
                                        v-model="form.password_confirmation"
                                        class="form-control"
                                        id="form-element-password-confirm"
                                        :class="{
                                            'is-invalid':
                                                errors.password_confirmation,
                                        }"
                                    />
                                    <div
                                        v-if="errors.password_confirmation"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.password_confirmation }}
                                    </div>
                                </div>
                                <div class="d-flex gap-3">
                                    <button
                                        type="submit"
                                        class="btn btn-outline-primary"
                                    >
                                        Submit
                                    </button>
                                    <button
                                        type="reset"
                                        class="btn btn-outline-secondary"
                                    >
                                        Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
