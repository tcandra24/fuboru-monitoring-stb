<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    users: Object,
});

const { links, from, to, total, current_page, per_page } = props.users;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});
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
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Pengguna</h5>
                            <Link
                                v-if="
                                    hasAnyPermission(['setting.users.create'])
                                "
                                href="/users/create"
                                as="button"
                                role="button"
                                class="btn btn-outline-primary mb-2"
                            >
                                <i class="bi bi-plus-lg me-1"></i> Tambah
                            </Link>

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Pelanggan</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="users.data.length > 0">
                                        <tr
                                            v-for="(user, index) in props.users
                                                .data"
                                            :key="index"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ user.kode_pelanggan }}</td>
                                            <td>{{ user.email }}</td>
                                            <td>{{ user.nama }}</td>
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
                                                <Link
                                                    :href="`/users/${user.id}/edit`"
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
                                            </td>
                                        </tr>
                                    </template>
                                    <tr v-else>
                                        <td colspan="5">Tidak ada Pengguna</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
