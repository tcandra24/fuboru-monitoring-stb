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
    roles: Object,
});

const toast = useToast();

const { links, from, to, total, last_page } = props.roles;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});

const destroy = (id, nama) => {
    Swal.fire({
        title: "Apa anda yakin?",
        text: `Data role "${nama}" akan dihapus`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete(`/setting/roles/${id}`);

            toast.open({
                message: "Role berhasil dihapus",
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
        <title>Role - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Role</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Role</h5>
                            <Link
                                v-if="
                                    hasAnyPermission(['setting.roles.create'])
                                "
                                href="/setting/roles/create"
                                as="button"
                                role="button"
                                class="btn btn-outline-primary mb-2"
                            >
                                <i class="bi bi-plus-lg me-1"></i> Tambah
                            </Link>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Ijin</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="roles.data.length > 0">
                                            <tr
                                                v-for="(role, index) in props
                                                    .roles.data"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ from++ }}
                                                </th>
                                                <td class="w-25">
                                                    {{ ucwords(role.name) }}
                                                </td>
                                                <td>
                                                    <div
                                                        class="d-flex flex-row gap-1 flex-wrap w-auto"
                                                    >
                                                        <span
                                                            v-for="(
                                                                permission,
                                                                index
                                                            ) in role.permissions"
                                                            :key="index"
                                                            class="badge rounded-pill bg-info text-dark"
                                                            >{{
                                                                ucwords(
                                                                    permission.name
                                                                )
                                                            }}</span
                                                        >
                                                    </div>
                                                </td>
                                                <td style="width: 10%">
                                                    <Link
                                                        :href="`/setting/roles/${role.id}/edit`"
                                                        v-if="
                                                            hasAnyPermission([
                                                                'setting.roles.edit',
                                                            ])
                                                        "
                                                    >
                                                        <i
                                                            class="bi bi-pencil me-1"
                                                        ></i>
                                                    </Link>
                                                    <button
                                                        class="btn"
                                                        @click.prevent="
                                                            destroy(
                                                                role.id,
                                                                role.name
                                                            )
                                                        "
                                                        v-if="
                                                            hasAnyPermission([
                                                                'setting.roles.delete',
                                                            ])
                                                        "
                                                    >
                                                        <i
                                                            class="bi bi-trash me-1 text-danger"
                                                        ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td colspan="4" class="text-center">
                                                Tidak ada Role
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
