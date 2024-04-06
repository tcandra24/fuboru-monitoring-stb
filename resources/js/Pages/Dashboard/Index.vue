<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    // user_count: Number,
    // branch_count: Number,
    // division_count: Number,
    // customer_count: Number,
    activeStb: Object,
});
</script>

<template>
    <Head>
        <title>Dashboard - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="alert alert-primary alert-dismissible fade show"
                        role="alert"
                    >
                        Selamat Datang
                        <strong>{{ $page.props.auth.user.nama }}</strong>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                </div>
                <!-- <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pengguna</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ props.user_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Cabang</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="bi bi-building"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ props.branch_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Divisi</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="bi bi-layers"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ props.division_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pelanggan</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="bi bi-bag"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ props.customer_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">STB Aktif</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nomer Kontrak</th>
                                            <th scope="col">Periode</th>
                                            <th scope="col">Total Omset</th>
                                            <th scope="col">
                                                Sisa Belum Tercapai
                                            </th>
                                            <th scope="col">Target (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="activeStb.length > 0">
                                            <tr
                                                v-for="(
                                                    stb, index
                                                ) in activeStb"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ index + 1 }}
                                                </th>
                                                <td>{{ stb.nomer_kontrak }}</td>
                                                <td>
                                                    {{
                                                        date_format(
                                                            stb.periode_awal
                                                        )
                                                    }}
                                                    -
                                                    {{
                                                        date_format(
                                                            stb.periode_akhir
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    Rp.
                                                    {{
                                                        moneyFormat(
                                                            stb.detail_stb_sum_omset
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    Rp.
                                                    {{
                                                        moneyFormat(
                                                            stb.target_rp -
                                                                stb.detail_stb_sum_omset
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    Rp.
                                                    {{
                                                        moneyFormat(
                                                            stb.target_rp
                                                        )
                                                    }}
                                                </td>
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td colspan="6" class="text-center">
                                                Tidak ada aktif STB
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div
                                class="d-grid gap-2 mt-3 justify-content-center"
                            >
                                <Link href="/report/stb">
                                    Tampilkan semua
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
