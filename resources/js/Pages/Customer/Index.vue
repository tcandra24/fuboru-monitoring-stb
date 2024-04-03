<script setup>
import LayoutApp from "../../Layouts/App.vue";
// import Pagination from "../../Components/Pagination.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    customers: Object,
});

const { links, from, to, total, current_page, per_page } = props.customers;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});
</script>

<template>
    <Head>
        <title>Pelanggan - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Pelanggan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Pelanggan</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Pelanggan</h5>
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
                                        <th scope="col">Email</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Kota</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Nama Divisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="customers.data.length > 0">
                                        <tr
                                            v-for="(customer, index) in props
                                                .customers.data"
                                            :key="index"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ customer.kode }}</td>
                                            <td>{{ customer.user.email }}</td>
                                            <td>{{ customer.nama }}</td>
                                            <td>{{ customer.alamat }}</td>
                                            <td>{{ customer.kota }}</td>
                                            <td>{{ customer.telepon }}</td>
                                            <td>
                                                {{ customer.division.nama }}
                                            </td>
                                        </tr>
                                    </template>
                                    <tr v-else>
                                        <td colspan="8" class="text-center">
                                            Tidak ada Pelanggan
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
