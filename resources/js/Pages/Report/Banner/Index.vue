<script setup>
import LayoutApp from "../../../Layouts/App.vue";
import Pagination from "../../../Components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    masterBanner: Object,
});

const toast = useToast();

const { links, from, to, total, last_page } = props.masterBanner;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});

const update = (kode_pelanggan, pelanggan) => {
    Swal.fire({
        title: "Apa anda yakin?",
        text: `Data pelanggan "${pelanggan}" tandai menjadi dikirim`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            const kodePelanggan = kode_pelanggan.replaceAll("/", "-");

            Inertia.patch(`/report/banner/update/${kodePelanggan}`);
            toast.open({
                message: "Spanduk berhasil diupdate",
                type: "success",
                duration: 2000,
                position: "bottom",
                dismissible: true,
            });
        }
    });
};
</script>

<template>
    <Head>
        <title>Report Spanduk - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Report Spanduk</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">Report</li>
                    <li class="breadcrumb-item active">Spanduk</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Report Spanduk</h5>
                            <div class="table-responsive">
                                <div class="d-flex gap-3">
                                    <a
                                        href="/report/export/banner"
                                        class="btn btn-outline-success mb-2"
                                        target="_blank"
                                    >
                                        Export
                                    </a>
                                </div>
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Pelanggan</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Kota</th>
                                            <th scope="col">Provinsi</th>
                                            <th scope="col">Tgl Pengajuan</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template
                                            v-if="masterBanner.data.length > 0"
                                        >
                                            <tr
                                                v-for="(banner, index) in props
                                                    .masterBanner.data"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ from++ }}
                                                </th>
                                                <td>
                                                    {{ ucwords(banner.Nama) }}
                                                </td>
                                                <td>
                                                    {{ ucwords(banner.Alamat) }}
                                                </td>
                                                <td>
                                                    {{ ucwords(banner.Kota) }}
                                                </td>
                                                <td>
                                                    {{
                                                        ucwords(banner.Provinsi)
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        date_format(
                                                            banner.tglpengajuan
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    <span class="h6">
                                                        Tgl Kirim:
                                                        {{
                                                            banner.tglpengiriman
                                                        }}
                                                    </span>
                                                    <br />
                                                    <span class="h6">
                                                        Tgl Pasang:
                                                        {{ banner.tglpasang }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn"
                                                        v-if="
                                                            hasAnyPermission([
                                                                'report.banner.change-status',
                                                            ]) &&
                                                            +banner.ispengajuan ===
                                                                1
                                                        "
                                                        @click.prevent="
                                                            update(
                                                                banner.KdPlg,
                                                                banner.Nama
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="bi bi-arrow-repeat me-1 text-primary"
                                                        ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td
                                                colspan="10"
                                                class="text-center"
                                            >
                                                Tidak ada Pengajuan Spanduk
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination
                                v-if="last_page > 1"
                                :pagination_links="pagination_links"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
