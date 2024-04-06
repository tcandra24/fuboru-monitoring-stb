<script setup>
import LayoutApp from "../../Layouts/App.vue";
// import Pagination from "../../Components/Pagination.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    masterStb: Object,
    detailStb: Object,
});
</script>

<template>
    <Head>
        <title>Report Detail STB - Monitoring STB</title>
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
                    <li class="breadcrumb-item">
                        <Link href="/report/stb"> STB </Link>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ props.masterStb.nomer_kontrak }}
                    </li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail STB</h5>
                            <div class="row">
                                <div class="d-flex flex-row">
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Nomer Kontrak :</h5>
                                        <p>
                                            {{ props.masterStb.nomer_kontrak }}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Pelanggan:</h5>
                                        <p>
                                            {{ props.masterStb.customer.nama }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex flex-row">
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Area :</h5>
                                        <p>
                                            {{ props.masterStb.branch.nama }}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Salesman:</h5>
                                        <p>
                                            {{ props.masterStb.salesman.nama }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex flex-row">
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Periode Awal :</h5>
                                        <p>
                                            {{
                                                date_format(
                                                    props.masterStb.periode_awal
                                                )
                                            }}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Periode Akhir:</h5>
                                        <p>
                                            {{
                                                date_format(
                                                    props.masterStb
                                                        .periode_akhir
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex flex-row">
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Target (Rp) :</h5>
                                        <p>
                                            Rp.
                                            {{
                                                moneyFormat(
                                                    props.masterStb.target_rp
                                                )
                                            }}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Hadiah (%):</h5>
                                        <p>
                                            {{ props.masterStb.hadiah_persen }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex flex-row">
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">Total Omset :</h5>
                                        <p>
                                            Rp.
                                            {{
                                                moneyFormat(
                                                    props.masterStb
                                                        .detail_stb_sum_omset
                                                )
                                            }}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-row w-100 gap-3">
                                        <h5 class="fw-bold">
                                            Sisa Belum Tercapai:
                                        </h5>
                                        <p>
                                            {{
                                                moneyFormat(
                                                    props.masterStb.target_rp -
                                                        props.masterStb
                                                            .detail_stb_sum_omset
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Omset</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="detailStb.length > 0">
                                            <tr
                                                v-for="(
                                                    stb, index
                                                ) in props.detailStb"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ index + 1 }}
                                                </th>
                                                <td>{{ stb.bulan }}</td>
                                                <td>{{ stb.tahun }}</td>
                                                <td>
                                                    Rp.
                                                    {{ moneyFormat(stb.omset) }}
                                                </td>
                                                <td>
                                                    Rp.
                                                    {{ moneyFormat(stb.total) }}
                                                </td>
                                                <td>{{ stb.persentase }}</td>
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td colspan="6" class="text-center">
                                                Tidak ada Detail STB
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">Total Omset</th>
                                            <td colspan="3">
                                                Rp.
                                                {{
                                                    moneyFormat(
                                                        props.masterStb
                                                            .detail_stb_sum_omset
                                                    )
                                                }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Table with hoverable rows -->
                            <!-- <Pagination :pagination_links="pagination_links" /> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
