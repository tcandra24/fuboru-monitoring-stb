<script setup>
import LayoutApp from "../../Layouts/App.vue";
import Pagination from "../../Components/Pagination.vue";
// import { Inertia } from "@inertiajs/inertia";
import Api from "../../axios";

import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    branches: Object,
});

const toast = useToast();

const { links, from, to, total, last_page } = props.branches;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});

const loading = ref(false);

const sync = () => {
    Swal.fire({
        title: "Apa anda Sync Cabang?",
        text: `Data cabang akan di update`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                loading.value = true;
                await Api.patch("/master/sync/branches");
                toast.open({
                    message: "Sukses sync Cabang",
                    type: "success",
                    duration: 2000,
                    position: "bottom",
                    dismissible: true,
                });
            } catch (error) {
                toast.open({
                    message: error,
                    type: "error",
                    duration: 2000,
                    position: "bottom",
                    dismissible: true,
                });
            } finally {
                loading.value = false;
            }
            // Inertia.patch(
            //     "/master/sync/branches",
            //     {},
            //     {
            //         onSuccess: () => {
            //             toast.open({
            //                 message: "Sukses sync area",
            //                 type: "success",
            //                 duration: 2000,
            //                 position: "bottom",
            //                 dismissible: true,
            //             });
            //         },
            //     }
            // );
        }
    });
};
</script>

<template>
    <Head>
        <title>Cabang - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Cabang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item">Master</li>
                    <li class="breadcrumb-item active">Cabang</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Cabang</h5>
                            <div class="d-flex gap-3">
                                <Link
                                    v-if="
                                        hasAnyPermission([
                                            'master.branches.create',
                                        ])
                                    "
                                    href="/master/branches/create"
                                    as="button"
                                    role="button"
                                    class="btn btn-outline-primary mb-2"
                                    :disabled="loading"
                                >
                                    <i class="bi bi-plus-lg me-1"></i> Tambah
                                </Link>
                                <button
                                    role="button"
                                    class="btn btn-outline-success mb-2"
                                    @click="sync"
                                    :disabled="loading"
                                >
                                    <span
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"
                                        v-if="loading"
                                    ></span>
                                    <i
                                        v-else
                                        class="bi bi-arrow-repeat me-1"
                                    ></i>
                                    Sync
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template
                                            v-if="branches.data.length > 0"
                                        >
                                            <tr
                                                v-for="(branch, index) in props
                                                    .branches.data"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ from++ }}
                                                </th>
                                                <td>{{ branch.kode }}</td>
                                                <td>{{ branch.nama }}</td>
                                                <td :style="{ width: '10%' }">
                                                    <Link
                                                        :href="`/master/branches/${branch.kode.replaceAll(
                                                            '/',
                                                            '-'
                                                        )}/edit`"
                                                        v-if="
                                                            hasAnyPermission([
                                                                'master.branches.edit',
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
                                            <td colspan="4" class="text-center">
                                                Tidak ada Cabang
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Table with hoverable rows -->
                                <Pagination
                                    v-if="last_page > 1"
                                    :pagination_links="pagination_links"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
