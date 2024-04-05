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
    permissions: Object,
});

const toast = useToast();

const form = reactive({
    name: "",
    permissions: [],
});

const all_permissions = props.permissions.map((data) => data.name);

const submit = () => {
    Inertia.post(
        "/setting/roles",
        {
            name: form.name,
            permissions: form.permissions,
        },
        {
            onSuccess: () => {
                toast.open({
                    message: "Sukses simpan role",
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
        <title>Tambah Role - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Tambah Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">
                        <Link href="/setting/roles">Role</Link>
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
                            <h5 class="card-title">Data Role</h5>
                            <form class="row g-3" @submit.prevent="submit">
                                <div class="col-12">
                                    <label
                                        for="form-element-nama"
                                        class="form-label"
                                        >Nama</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.name"
                                        class="form-control"
                                        id="form-element-nama"
                                        :class="{ 'is-invalid': errors.name }"
                                    />
                                    <div
                                        v-if="errors.name"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.name }}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label
                                        for="form-element-roles"
                                        class="form-label"
                                        >Izin</label
                                    >
                                    <Multiselect
                                        v-model="form.permissions"
                                        :options="all_permissions"
                                        mode="tags"
                                        :class="{
                                            'is-invalid': errors.permissions,
                                        }"
                                    />
                                    <div
                                        v-if="errors.permissions"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.permissions }}
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
