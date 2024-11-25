<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    // user_count: Number,
    // branch_count: Number,
    // division_count: Number,
    // customer_count: Number,
    activeStb: Object,
    activeBanner: Object,
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
                <div
                    class="col-lg-12"
                    v-if="hasAnyPermission(['report.stb.index'])"
                >
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">STB Aktif</h5>
                            <div class="table-responsive">
                                <table class="table">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="activeStb.length > 0">
                                            <tr
                                                v-for="(
                                                    stb, index
                                                ) of activeStb"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ index + 1 }}
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
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td colspan="9" class="text-center">
                                                Tidak ada STB aktif
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
                <div
                    class="col-lg-12"
                    v-if="hasAnyPermission(['report.banner.index'])"
                >
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pengajuan Spanduk Aktif</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Pelanggan</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Kota</th>
                                            <th scope="col">Provinsi</th>
                                            <th scope="col">Tgl Pengajuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template
                                            v-if="activeBanner.length > 0"
                                        >
                                            <tr
                                                v-for="(
                                                    banner, index
                                                ) of activeBanner"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ index + 1 }}
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
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td colspan="7" class="text-center">
                                                Tidak ada Pengajuan Spanduk
                                                Aktif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div
                                class="d-grid gap-2 mt-3 justify-content-center"
                            >
                                <Link href="/report/banner">
                                    Tampilkan semua Spanduk
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
