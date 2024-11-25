<script setup>
import LayoutApp from "../../../Layouts/App.vue";
import Pagination from "../../../Components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref, reactive } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const props = defineProps({
    masterStb: Object,
    request: Object,
});

const toast = useToast();

const { links, from, to, total, last_page, current_page, per_page } =
    props.masterStb;

const pagination_links = ref({
    links: links,
    from: from,
    to: to,
    total: total,
});

const search = reactive({
    customerName: props.request.customerName ?? "",
    dateStart: props.request.dateStart ?? "",
    dateEnd: props.request.dateEnd ?? "",
    isInsert: props.request.isInsert ?? "",
});

const update = (kode_nota, pelanggan) => {
    Swal.fire({
        title: "Apa anda yakin?",
        text: `Data STB "${pelanggan}" akan ditandai sudah diinput`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            const kodeNota = kode_nota.replaceAll("/", "-");

            Inertia.patch(`/report/stb/update/${kodeNota}`);
            toast.open({
                message: "STB berhasil diupdate",
                type: "success",
                duration: 2000,
                position: "bottom",
                dismissible: true,
            });
        }
    });
};

const submit = () => {
    Inertia.get("/report/stb", {
        customerName: search.customerName,
        dateStart: search.dateStart,
        dateEnd: search.dateEnd,
        isInsert: search.isInsert,
    });
};

const reset = () => {
    search.customerName = "";
    search.dateStart = "";
    search.dateEnd = "";
    search.isInsert = "";
};
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
                    <li class="breadcrumb-item">Report</li>
                    <li class="breadcrumb-item active">STB</li>
                </ol>
            </nav>
        </div>
        <section class="section min-vh-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Report STB</h5>

                            <form class="row g-3 mb-3" @submit.prevent="submit">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <label
                                        for="form-element-nama"
                                        class="form-label"
                                        >Pelanggan</label
                                    >
                                    <input
                                        type="text"
                                        v-model="search.customerName"
                                        class="form-control"
                                    />
                                </div>

                                <div class="col-lg-3 col-md-6 col-12">
                                    <label
                                        for="form-element-nama"
                                        class="form-label"
                                        >Periode Awal</label
                                    >
                                    <input
                                        type="date"
                                        v-model="search.dateStart"
                                        class="form-control"
                                    />
                                </div>

                                <div class="col-lg-3 col-md-6 col-12">
                                    <label
                                        for="form-element-nama"
                                        class="form-label"
                                        >Periode Akhir</label
                                    >
                                    <input
                                        type="date"
                                        v-model="search.dateEnd"
                                        class="form-control"
                                    />
                                </div>

                                <div class="col-lg-3 col-md-6 col-12">
                                    <label
                                        for="form-element-nama"
                                        class="form-label"
                                        >Status</label
                                    >
                                    <select
                                        v-model="search.isInsert"
                                        class="form-control"
                                    >
                                        <option value="">Pilih Status</option>
                                        <option value="Y">Sudah Input</option>
                                        <option value="N">Belum Input</option>
                                    </select>
                                </div>

                                <div class="col-12 d-flex" style="gap: 10px">
                                    <button
                                        class="btn btn-outline-primary"
                                        type="submit"
                                    >
                                        Cari
                                    </button>
                                    <button
                                        class="btn btn-outline-secondary"
                                        @click="reset"
                                    >
                                        Reset
                                    </button>
                                </div>
                            </form>
                            <hr />
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <div class="d-flex gap-3">
                                            <a
                                                :href="`/report/export/stb?customerName=${
                                                    request.customerName ?? ''
                                                }&dateEnd=${
                                                    request.dateEnd ?? ''
                                                }&dateStart=${
                                                    request.dateStart ?? ''
                                                }&isInsert=${
                                                    request.isInsert ?? ''
                                                }`"
                                                class="btn btn-outline-success mb-2"
                                                target="_blank"
                                            >
                                                Export
                                            </a>
                                        </div>
                                        <table
                                            class="table table-hover table-striped"
                                        >
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">
                                                        Kode Nota
                                                    </th>
                                                    <th scope="col">
                                                        Pelanggan
                                                    </th>
                                                    <th scope="col">
                                                        Periode Awal
                                                    </th>
                                                    <th scope="col">
                                                        Periode Akhir
                                                    </th>
                                                    <th scope="col">
                                                        Target (Rp)
                                                    </th>
                                                    <th scope="col">
                                                        Hadiah (%)
                                                    </th>
                                                    <th scope="col">Jenis</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template
                                                    v-if="
                                                        masterStb.data.length >
                                                        0
                                                    "
                                                >
                                                    <tr
                                                        v-for="(
                                                            stb, index
                                                        ) in props.masterStb
                                                            .data"
                                                        :key="index"
                                                        :class="[
                                                            +stb.is_insert === 1
                                                                ? 'text-decoration-line-through'
                                                                : '',
                                                        ]"
                                                    >
                                                        <th scope="row">
                                                            {{
                                                                (current_page -
                                                                    1) *
                                                                    per_page +
                                                                index +
                                                                1
                                                            }}
                                                        </th>
                                                        <td>
                                                            {{ stb.kodenota }}
                                                        </td>
                                                        <td>
                                                            <p>
                                                                {{ stb.kdplg }}
                                                            </p>
                                                            <p>
                                                                {{ stb.nmplg }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            {{
                                                                date_format(
                                                                    stb.awal
                                                                )
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{
                                                                date_format(
                                                                    stb.akhir
                                                                )
                                                            }}
                                                        </td>
                                                        <td>
                                                            Rp.
                                                            {{
                                                                moneyFormat(
                                                                    stb.kontrak
                                                                )
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ stb.hadiah }} %
                                                        </td>
                                                        <td>{{ stb.jenis }}</td>
                                                        <td>
                                                            <button
                                                                class="btn"
                                                                v-if="
                                                                    hasAnyPermission(
                                                                        [
                                                                            'report.stb.change-status',
                                                                        ]
                                                                    ) &&
                                                                    +stb.is_insert !==
                                                                        1
                                                                "
                                                                @click.prevent="
                                                                    update(
                                                                        stb.kodenota,
                                                                        stb.nmplg
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="bi bi-arrow-repeat me-1 text-primary"
                                                                ></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <tr v-else>
                                                    <td
                                                        colspan="11"
                                                        class="text-center"
                                                    >
                                                        Tidak ada STB
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <Pagination
                                        v-if="last_page > 1"
                                        :pagination_links="pagination_links"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
