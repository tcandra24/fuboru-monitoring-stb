<script setup>
import LayoutApp from "../../Layouts/App.vue";
// import Pagination from "../../Components/Pagination.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    salesmans: Object,
});

const { links, from, to, total, current_page, per_page } = props.salesmans;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});
</script>

<template>
    <Head>
        <title>Salesman - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Salesman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Salesman</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Salesman</h5>
                            <Link
                                href="#"
                                as="button"
                                role="button"
                                class="btn btn-outline-success mb-2"
                            >
                                <i class="bi bi-arrow-repeat me-1"></i> Sync
                            </Link>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Kota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="salesmans.data.length > 0">
                                        <tr
                                            v-for="(salesman, index) in props
                                                .salesmans.data"
                                            :key="index"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ salesman.kode }}</td>
                                            <td>{{ salesman.nama }}</td>
                                            <td>{{ salesman.alamat }}</td>
                                            <td>{{ salesman.kota }}</td>
                                        </tr>
                                    </template>
                                    <tr v-else>
                                        <td colspan="5" class="text-center">
                                            Tidak ada Salesman
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->
                            <!-- <Pagination :pagination_links="pagination_links" /> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
