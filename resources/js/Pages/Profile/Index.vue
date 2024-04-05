<script setup>
import LayoutApp from "../../Layouts/App.vue";
import { reactive } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const form = reactive({
    old_password: "",
    new_password: "",
    new_password_confirmation: "",
});

const toast = useToast();

const { errors } = defineProps({
    errors: Object,
});

const submit = () => {
    Inertia.post(
        "/profile/change-password",
        {
            old_password: form.old_password,
            new_password: form.new_password,
            new_password_confirmation: form.new_password_confirmation,
        },
        {
            onSuccess: (response) => {
                const { props } = response;
                if (props.session.error) {
                    return toast.open({
                        message: props.session.error,
                        type: "error",
                        duration: 2000,
                        position: "bottom",
                        dismissible: true,
                    });
                }

                form.old_password = "";
                form.new_password = "";
                form.new_password_confirmation = "";
                return toast.open({
                    message: "Sukses ubah password",
                    type: "success",
                    duration: 2000,
                    position: "bottom",
                    dismissible: true,
                });
            },
        }
    );
};
</script>

<template>
    <Head>
        <title>Profile - Monitoring STB</title>
    </Head>

    <LayoutApp>
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <Link href="/">Home</Link>
                    </li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
        <section class="section profile min-vh-100">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div
                            class="card-body profile-card pt-4 d-flex flex-column align-items-center"
                        >
                            <img
                                :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.nama}&amp;background=4e73df&amp;color=ffffff&amp;size=100`"
                                alt="Profile"
                                class="rounded-circle"
                            />
                            <h2>{{ $page.props.auth.user.nama }}</h2>
                            <h3
                                v-for="(role, index) in $page.props.auth.user
                                    .roles"
                                :key="index"
                            >
                                {{ ucwords(role.name) }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul
                                class="nav nav-tabs nav-tabs-bordered"
                                role="tablist"
                            >
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#profile-overview"
                                        aria-selected="true"
                                        role="tab"
                                    >
                                        Ringkasan
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password"
                                        aria-selected="false"
                                        tabindex="-1"
                                        role="tab"
                                    >
                                        Ganti Password
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div
                                    class="tab-pane fade show active profile-overview"
                                    id="profile-overview"
                                    role="tabpanel"
                                >
                                    <h5 class="card-title">Detail Profil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Nama
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $page.props.auth.user.nama }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Email
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $page.props.auth.user.email }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">
                                            Kode Pelanggan
                                        </div>
                                        <div class="col-lg-9 col-md-8">
                                            {{
                                                $page.props.auth.user
                                                    .kode_pelanggan
                                            }}
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="tab-pane fade pt-3"
                                    id="profile-change-password"
                                    role="tabpanel"
                                >
                                    <!-- Change Password Form -->
                                    <form @submit.prevent="submit">
                                        <div class="row mb-3">
                                            <label
                                                for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label"
                                                >Password Sekarang</label
                                            >
                                            <div class="col-md-6 col-lg-8">
                                                <input
                                                    name="password"
                                                    type="password"
                                                    class="form-control"
                                                    id="currentPassword"
                                                    v-model="form.old_password"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.old_password,
                                                    }"
                                                />
                                                <div
                                                    v-if="errors.old_password"
                                                    class="invalid-feedback"
                                                >
                                                    {{ errors.old_password }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label
                                                for="newPassword"
                                                class="col-md-4 col-lg-3 col-form-label"
                                                >Password Baru</label
                                            >
                                            <div class="col-md-6 col-lg-8">
                                                <input
                                                    name="newpassword"
                                                    type="password"
                                                    class="form-control"
                                                    id="newPassword"
                                                    v-model="form.new_password"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.new_password,
                                                    }"
                                                />
                                                <div
                                                    v-if="errors.new_password"
                                                    class="invalid-feedback"
                                                >
                                                    {{ errors.new_password }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label
                                                for="renewPassword"
                                                class="col-md-4 col-lg-3 col-form-label"
                                                >Konfirmasi Password Baru
                                            </label>
                                            <div class="col-md-6 col-lg-8">
                                                <input
                                                    name="renewpassword"
                                                    type="password"
                                                    class="form-control"
                                                    id="renewPassword"
                                                    v-model="
                                                        form.new_password_confirmation
                                                    "
                                                    :class="{
                                                        'is-invalid':
                                                            errors.new_password_confirmation,
                                                    }"
                                                />
                                                <div
                                                    v-if="
                                                        errors.new_password_confirmation
                                                    "
                                                    class="invalid-feedback"
                                                >
                                                    {{
                                                        errors.new_password_confirmation
                                                    }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-left">
                                            <button
                                                type="submit"
                                                class="btn btn-outline-primary"
                                            >
                                                Change Password
                                            </button>
                                        </div>
                                    </form>
                                    <!-- End Change Password Form -->
                                </div>
                            </div>
                            <!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </LayoutApp>
</template>
