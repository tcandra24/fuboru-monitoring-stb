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
    users: Object,
});

const toast = useToast();

const { links, from, to, total, last_page } = props.users;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});

const destroy = (id, nama) => {
    Swal.fire({
        title: "Apa anda yakin?",
        text: `Data pengguna "${nama}" akan dihapus`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete(`/setting/users/${id}`);

            toast.open({
                message: "Pengguna berhasil dihapus",
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
        <title>Pengguna - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Pengguna</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Pengguna</h5>
                            <Link
                                v-if="
                                    hasAnyPermission(['setting.users.create'])
                                "
                                href="/setting/users/create"
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
                                            <th scope="col">Pelanggan</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kota</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Valid</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="users.data.length > 0">
                                            <tr
                                                v-for="(user, index) in props
                                                    .users.data"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ from++ }}
                                                </th>
                                                <td>
                                                    {{
                                                        user.kode_pelanggan ||
                                                        "-"
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        user.branch
                                                            ? user.branch.nama
                                                            : "-"
                                                    }}
                                                </td>
                                                <td>{{ user.email }}</td>
                                                <td>{{ user.nama }}</td>
                                                <td>
                                                    {{
                                                        user.customer
                                                            ? user.customer.kota
                                                            : "-"
                                                    }}
                                                </td>
                                                <td>
                                                    <span
                                                        v-for="(
                                                            role, index
                                                        ) in user.roles"
                                                        :key="index"
                                                        class="badge rounded-pill bg-info text-dark"
                                                        >{{
                                                            ucwords(role.name)
                                                        }}</span
                                                    >
                                                </td>
                                                <td>
                                                    <span
                                                        v-if="user.valid"
                                                        class="badge rounded-pill bg-info text-dark"
                                                        >Valid</span
                                                    >
                                                    <span
                                                        v-else
                                                        class="badge rounded-pill bg-danger text-dark"
                                                    >
                                                        Tidak Valid
                                                    </span>
                                                </td>
                                                <td>
                                                    <Link
                                                        :href="`/setting/users/${user.id}/edit`"
                                                        v-if="
                                                            hasAnyPermission([
                                                                'setting.users.edit',
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
                                                                user.id,
                                                                user.nama
                                                            )
                                                        "
                                                        v-if="
                                                            hasAnyPermission([
                                                                'setting.users.delete',
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
                                            <td colspan="6" class="text-center">
                                                Tidak ada Pengguna
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
