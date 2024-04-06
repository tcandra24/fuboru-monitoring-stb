<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    permissions: Object,
});
</script>

<template>
    <Head>
        <title>Permission - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Permission</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Permission</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Permission</h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Guard</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template
                                            v-if="permissions.data.length > 0"
                                        >
                                            <tr
                                                v-for="(
                                                    permission, index
                                                ) in props.permissions.data"
                                                :key="index"
                                            >
                                                <th scope="row">
                                                    {{ index + 1 }}
                                                </th>
                                                <td>{{ permission.name }}</td>
                                                <td>
                                                    {{ permission.guard_name }}
                                                </td>
                                            </tr>
                                        </template>
                                        <tr v-else>
                                            <td colspan="3" class="text-center">
                                                Tidak ada Permission
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with hoverable rows -->
                            <!-- <Pagination :pagination_links="pagination_links" /> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
