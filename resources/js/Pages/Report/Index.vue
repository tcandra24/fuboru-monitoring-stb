<script setup>
import LayoutApp from "../../Layouts/App.vue";
import Pagination from "../../Components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    masterStb: Object,
});

const toast = useToast();

const { links, from, to, total, last_page } = props.masterStb;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});

const update = (kode_nota, pelanggan) => {
    Swal.fire({
        title: "Apa anda yakin?",
        text: `Data STB "${pelanggan}" akan ditandai sudah diinput`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            const kodeNota = kode_nota.replaceAll("/", "-");

            Inertia.patch(`/report/stb/update/${kodeNota}`);
            toast.open({
                message: "STB berhasil diupdate",
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
        <title>Report STB - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Report STB</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">Report</li>
                    <li class="breadcrumb-item active">STB</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Report STB</h5>
                            <div class="table-responsive">
                                <div class="d-flex gap-3">
                                    <a
                                        href="/report/export/stb"
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
                                            <th scope="col">Kode Nota</th>
                                            <th scope="col">Kode Pelanggan</th>
                                            <th scope="col">Pelanggan</th>
                                            <th scope="col">Periode Awal</th>
                                            <th scope="col">Periode Akhir</th>
                                            <th scope="col">Target (Rp)</th>
                                            <th scope="col">Hadiah (%)</th>
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template
                                            v-if="masterStb.data.length > 0"
                                        >
                                            <tr
                                                v-for="(stb, index) in props
                                                    .masterStb.data"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ from++ }}
                                                </th>
                                                <td>
                                                    {{ stb.kodenota }}
                                                </td>
                                                <td>{{ stb.kdplg }}</td>
                                                <td>{{ stb.nmplg }}</td>
                                                <td>
                                                    {{ date_format(stb.awal) }}
                                                </td>
                                                <td>
                                                    {{ date_format(stb.akhir) }}
                                                </td>
                                                <td>
                                                    Rp.
                                                    {{
                                                        moneyFormat(stb.kontrak)
                                                    }}
                                                </td>
                                                <td>{{ stb.hadiah }} %</td>
                                                <td>{{ stb.jenis }}</td>
                                                <td>
                                                    <button
                                                        class="btn"
                                                        v-if="
                                                            hasAnyPermission([
                                                                'report.stb.change-status',
                                                            ])
                                                        "
                                                        @click.prevent="
                                                            update(
                                                                stb.kodenota,
                                                                stb.nmplg
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
                                                Tidak ada STB
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
