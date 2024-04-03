<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    user_count: Number,
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

        <section class="section dashboard">
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
                <div class="col-lg-8">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
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
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
