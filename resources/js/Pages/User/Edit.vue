<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";

const props = defineProps({
    errors: Object,
    user: Object,
    roles: Object,
});

const form = reactive({
    nama: props.user.nama,
    kode_pelanggan: props.user.kode_pelanggan,
    email: props.user.email,
    password: "",
    password_confirmation: "",
    roles: props.user.roles.map((obj) => obj.name),
});

const all_role = props.roles.map((data) => data.name);

const submit = () => {
    Inertia.post(
        `/users/${props.user.id}`,
        {
            _method: "PUT",
            nama: form.nama,
            kode_pelanggan: form.kode_pelanggan,
            email: form.email,
            password: form.password,
            password_confirmation: form.password_confirmation,
            roles: form.roles,
        },
        {
            onSuccess: () => {
                console.log("sukses");
            },
        }
    );
};
</script>

<template>
    <Head>
        <title>Edit Pengguna - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Edit Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">
                        <Link href="/users">Pengguna</Link>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
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
                                <div class="col-6">
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
                                    />
                                </div>
                                <div class="col-6">
                                    <label
                                        for="form-element-kode-pelanggan"
                                        class="form-label"
                                        >Kode Pelanggan</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.kode_pelanggan"
                                        class="form-control"
                                        id="form-element-kode-pelanggan"
                                    />
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
                                    />
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
                                    />
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
                                    />
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
                                    />
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
