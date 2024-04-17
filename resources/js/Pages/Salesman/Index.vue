<script setup>
import LayoutApp from "../../Layouts/App.vue";
import Pagination from "../../Components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

const props = defineProps({
    salesmans: Object,
});

const { links, from, to, total, last_page } = props.salesmans;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});

const sync = () => {
    Swal.fire({
        title: "Apa anda Sync Salesman?",
        text: `Data salesman akan di update`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.patch(
                "/master/sync/salesmans",
                {},
                {
                    onSuccess: () => {
                        toast.open({
                            message: "Sukses sync salesman",
                            type: "success",
                            duration: 2000,
                            position: "bottom",
                            dismissible: true,
                        });
                    },
                }
            );
        }
    });
};
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
                    <li class="breadcrumb-item">Master</li>
                    <li class="breadcrumb-item active">Salesman</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Salesman</h5>
                            <div class="d-flex gap-3">
                                <Link
                                    v-if="
                                        hasAnyPermission([
                                            'master.salesmans.create',
                                        ])
                                    "
                                    href="/master/salesmans/create"
                                    as="button"
                                    role="button"
                                    class="btn btn-outline-primary mb-2"
                                >
                                    <i class="bi bi-plus-lg me-1"></i> Tambah
                                </Link>
                                <button
                                    role="button"
                                    class="btn btn-outline-success mb-2"
                                    @click="sync"
                                >
                                    <i class="bi bi-arrow-repeat me-1"></i> Sync
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Kota</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template
                                            v-if="salesmans.data.length > 0"
                                        >
                                            <tr
                                                v-for="(
                                                    salesman, index
                                                ) in props.salesmans.data"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ from++ }}
                                                </th>
                                                <td>{{ salesman.kode }}</td>
                                                <td>{{ salesman.nama }}</td>
                                                <td>{{ salesman.alamat }}</td>
                                                <td>{{ salesman.kota }}</td>
                                                <td :style="{ width: '10%' }">
                                                    <Link
                                                        :href="`/master/salesmans/${salesman.kode.replaceAll(
                                                            '/',
                                                            '-'
                                                        )}/edit`"
                                                        v-if="
                                                            hasAnyPermission([
                                                                'master.salesmans.edit',
                                                            ])
                                                        "
                                                    >
                                                        <i
                                                            class="bi bi-pencil me-1"
                                                        ></i>
                                                    </Link>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td colspan="6" class="text-center">
                                                Tidak ada Salesman
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with hoverable rows -->
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
