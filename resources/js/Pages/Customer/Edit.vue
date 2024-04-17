<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    errors: Object,
    branches: Object,
    divisions: Object,
    customer: Object,
});

const toast = useToast();

const form = reactive({
    kode: props.customer.kode,
    nama: props.customer.nama,
    alamat: props.customer.alamat,
    kota: props.customer.kota,
    kode_pos: props.customer.kode_pos,
    kecamatan: props.customer.kecamatan,
    kelurahan: props.customer.kelurahan,
    telepon: props.customer.telepon,
    kode_divisi: props.customer.kode_divisi,
    kode_area: props.customer.kode_area,
});

const submit = () => {
    Inertia.post(
        `/master/customers/${props.customer.kode.replaceAll("/", "-")}`,
        {
            _method: "PUT",
            kode: form.kode,
            nama: form.nama,
            alamat: form.alamat,
            kota: form.kota,
            kode_pos: form.kode_pos,
            kecamatan: form.kecamatan,
            kelurahan: form.kelurahan,
            telepon: form.telepon,
            kode_divisi: form.kode_divisi,
            kode_area: form.kode_area,
        },
        {
            onSuccess: () => {
                toast.open({
                    message: "Sukses simpan Pelanggan",
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
        <title>Edit Pelanggan - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Pelanggan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">Master</li>
                    <li class="breadcrumb-item">
                        <Link href="/master/customers">Pelanggan</Link>
                    </li>
                    <li class="breadcrumb-item active">{{ customer.kode }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Pelanggan</h5>
                            <form class="row g-3" @submit.prevent="submit">
                                <div class="col-3">
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
                                <div class="col-3">
                                    <label
                                        for="form-element-kode-pos"
                                        class="form-label"
                                        >Kode Pos</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.kode_pos"
                                        class="form-control"
                                        id="form-element-kode-pos"
                                        :class="{
                                            'is-invalid': errors.kode_pos,
                                        }"
                                    />
                                    <div
                                        v-if="errors.kode_pos"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.kode_pos }}
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label
                                        for="form-element-keluarahan"
                                        class="form-label"
                                        >Kelurahan</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.kelurahan"
                                        class="form-control"
                                        id="form-element-kelurahan"
                                        :class="{
                                            'is-invalid': errors.kelurahan,
                                        }"
                                    />
                                    <div
                                        v-if="errors.kelurahan"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.kelurahan }}
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label
                                        for="form-element-kecamatan"
                                        class="form-label"
                                        >Kecamatan</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.kecamatan"
                                        class="form-control"
                                        id="form-element-kecamatan"
                                        :class="{
                                            'is-invalid': errors.kecamatan,
                                        }"
                                    />
                                    <div
                                        v-if="errors.kecamatan"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.kecamatan }}
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label
                                        for="form-element-kota"
                                        class="form-label"
                                        >Kota</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.kota"
                                        class="form-control"
                                        id="form-element-kota"
                                        :class="{ 'is-invalid': errors.kota }"
                                    />
                                    <div
                                        v-if="errors.kota"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.kota }}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label
                                        for="form-element-divisi"
                                        class="form-label"
                                        >Divisi</label
                                    >
                                    <select
                                        v-model="form.kode_divisi"
                                        id="form-element-divisi"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.kode_divisi,
                                        }"
                                    >
                                        <option value="">Pilih Divisi</option>
                                        <option
                                            v-for="(
                                                division, index
                                            ) in divisions"
                                            :key="index"
                                            :value="division.kode"
                                        >
                                            {{ division.nama }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="errors.kode_divisi"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.kode_divisi }}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label
                                        for="form-element-area"
                                        class="form-label"
                                        >Area</label
                                    >
                                    <select
                                        v-model="form.kode_area"
                                        id="form-element-area"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.kode_area,
                                        }"
                                    >
                                        <option value="">Pilih Area</option>
                                        <option
                                            v-for="(branch, index) in branches"
                                            :key="index"
                                            :value="branch.kode"
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
                                <div class="col-3">
                                    <label
                                        for="form-element-telepon"
                                        class="form-label"
                                        >Telepon</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.telepon"
                                        class="form-control"
                                        id="form-element-telepon"
                                        :class="{
                                            'is-invalid': errors.telepon,
                                        }"
                                    />
                                    <div
                                        v-if="errors.telepon"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.telepon }}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label
                                        for="form-element-alamat"
                                        class="form-label"
                                        >Alamat</label
                                    >
                                    <textarea
                                        type="text"
                                        v-model="form.alamat"
                                        class="form-control"
                                        id="form-element-alamat"
                                        :class="{ 'is-invalid': errors.alamat }"
                                    ></textarea>
                                    <div
                                        v-if="errors.alamat"
                                        class="invalid-feedback"
                                    >
                                        {{ errors.alamat }}
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
