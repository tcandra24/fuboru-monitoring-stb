<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";

const isNavClose = ref(true);

const toggleNavbar = () => {
    if (isNavClose.value) {
        document.body.classList.add("toggle-sidebar");
    } else {
        document.body.classList.remove("toggle-sidebar");
    }
    isNavClose.value = !isNavClose.value;
};
</script>

<template>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <Link href="/" class="logo d-flex align-items-center">
                <img src="/admin/img/logo.png" alt="" />
                <span class="d-none d-lg-block">Fuboru</span>
            </Link>
            <i @click="toggleNavbar" class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle" href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <li class="nav-item dropdown pe-3">
                    <a
                        class="nav-link nav-profile d-flex align-items-center pe-0"
                        href="#"
                        data-bs-toggle="dropdown"
                    >
                        <img
                            :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.nama}&amp;background=4e73df&amp;color=ffffff&amp;size=100`"
                            alt="Profile"
                            class="rounded-circle"
                        />
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            {{ $page.props.auth.user.nama }}
                        </span>
                    </a>

                    <ul
                        class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                    >
                        <li class="dropdown-header">
                            <h6>{{ $page.props.auth.user.nama }}</h6>
                            <span
                                v-for="(role, index) in $page.props.auth.user
                                    .roles"
                                :key="index"
                                >{{ ucwords(role.name) }}</span
                            >
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <Link
                                class="dropdown-item d-flex align-items-center"
                                href="/profile"
                            >
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </Link>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <Link
                                class="dropdown-item d-flex align-items-center"
                                href="/logout"
                                method="POST"
                                as="button"
                                role="button"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </Link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
</template>
