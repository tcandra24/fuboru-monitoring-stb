<script setup>
import LayoutApp from "../../Layouts/App.vue";
// import Pagination from "../../Components/Pagination.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    divisions: Object,
});

const { links, from, to, total, current_page, per_page } = props.divisions;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});
</script>

<template>
    <Head>
        <title>Divisi - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Divisi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Divisi</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Divisi</h5>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="divisions.data.length > 0">
                                        <tr
                                            v-for="(division, index) in props
                                                .divisions.data"
                                            :key="index"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ division.kode }}</td>
                                            <td>{{ division.nama }}</td>
                                        </tr>
                                    </template>
                                    <tr v-else>
                                        <td colspan="3" class="text-center">
                                            Tidak ada Divisi
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
