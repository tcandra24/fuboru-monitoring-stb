<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    errors: Object,
    permissions: Object,
    branch: Object,
});

const toast = useToast();

const form = reactive({
    kode: props.branch.kode,
    nama: props.branch.nama,
});

const submit = () => {
    Inertia.post(
        `/master/branches/${props.branch.kode.replaceAll("/", "-")}`,
        {
            _method: "PUT",
            kode: form.kode,
            nama: form.nama,
        },
        {
            onSuccess: () => {
                toast.open({
                    message: "Sukses simpan Cabang",
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
        <title>Edit Cabang - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Cabang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">Master</li>
                    <li class="breadcrumb-item">
                        <Link href="/master/branches">Cabang</Link>
                    </li>
                    <li class="breadcrumb-item active">{{ branch.kode }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Cabang</h5>
                            <form class="row g-3" @submit.prevent="submit">
                                <div class="col-6">
                                    <label
                                        for="form-element-kode"
                                        class="form-label"
                                        >Kode</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.kode"
                                        class="form-control"
                                        id="form-element-kode"
                                        :class="{ 'is-invalid': errors.kode }"
                                        disabled
                                    />
                                    <div
                                        v-if="errors.kode"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.kode }}
                                    </div>
                                </div>
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
                                        :class="{ 'is-invalid': errors.nama }"
                                    />
                                    <div
                                        v-if="errors.nama"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.nama }}
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
