<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item" v-if="hasAnyPermission(['dashboard.index'])">
                <Link class="nav-link" href="/">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </Link>
            </li>

            <li class="nav-item" v-if="hasAnyPermission(['report.stb.index'])">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#forms-nav"
                    data-bs-toggle="collapse"
                    href="#"
                >
                    <i class="bi bi-journal-text"></i>
                    <span>Laporan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="forms-nav"
                    class="nav-content collapse"
                    data-bs-parent="#sidebar-nav"
                >
                    <li v-if="hasAnyPermission(['report.stb.index'])">
                        <a href="forms-elements.html">
                            <i class="bi bi-circle"></i><span>STB</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="nav-heading"
                v-if="
                    hasAnyPermission(['setting.users.index']) ||
                    hasAnyPermission(['setting.roles.index']) ||
                    hasAnyPermission(['setting.permissions.index'])
                "
            >
                Setting
            </li>

            <li
                class="nav-item"
                v-if="hasAnyPermission(['setting.users.index'])"
            >
                <Link class="nav-link collapsed" href="/users">
                    <i class="bi bi-person"></i>
                    <span>Pengguna</span>
                </Link>
            </li>

            <li
                class="nav-item"
                v-if="hasAnyPermission(['setting.roles.index'])"
            >
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-question-circle"></i>
                    <span>Role</span>
                </a>
            </li>

            <li
                class="nav-item"
                v-if="hasAnyPermission(['setting.permissions.index'])"
            >
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-envelope"></i>
                    <span>Izin</span>
                </a>
            </li>
        </ul>
    </aside>
</template>
