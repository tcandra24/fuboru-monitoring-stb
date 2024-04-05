<script setup>
import LayoutApp from "../../Layouts/App.vue";
// import Pagination from "../../Components/Pagination.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    masterStb: Object,
});

const { links, from, to, total, current_page, per_page } = props.masterStb;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});
</script>

<template>
    <Head>
        <title>Report STB - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Report STB</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Report STB</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Report STB</h5>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomer Kontrak</th>
                                        <th scope="col">Salesman</th>
                                        <th scope="col">Periode Awal</th>
                                        <th scope="col">Periode Akhir</th>
                                        <th scope="col">Total Omset</th>
                                        <th scope="col">Sisa Belum Tercapai</th>
                                        <th scope="col">Target (Rp)</th>
                                        <th scope="col">Hadiah (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="masterStb.data.length > 0">
                                        <tr
                                            v-for="(stb, index) in props
                                                .masterStb.data"
                                            :key="index"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>
                                                <Link
                                                    :href="`/report/stb/${stb.nomer_kontrak}`"
                                                >
                                                    {{ stb.nomer_kontrak }}
                                                </Link>
                                            </td>
                                            <td>{{ stb.salesman.nama }}</td>
                                            <td>
                                                {{
                                                    date_format(
                                                        stb.periode_awal
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                    date_format(
                                                        stb.periode_akhir
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                Rp.
                                                {{
                                                    moneyFormat(
                                                        stb.detail_stb_sum_omset
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                Rp.
                                                {{
                                                    moneyFormat(
                                                        stb.target_rp -
                                                            stb.detail_stb_sum_omset
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                Rp.
                                                {{ moneyFormat(stb.target_rp) }}
                                            </td>
                                            <td>{{ stb.hadiah_persen }}</td>
                                        </tr>
                                    </template>
                                    <tr v-else>
                                        <td colspan="9" class="text-center">
                                            Tidak ada STB
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
