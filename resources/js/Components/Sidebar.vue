<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item" v-if="hasAnyPermission(['dashboard.index'])">
                <Link
                    class="nav-link"
                    href="/dashboard"
                    :class="[
                        !$page.url.startsWith('/dashboard') ? 'collapsed' : '',
                    ]"
                >
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </Link>
            </li>

            <li
                class="nav-item"
                v-if="
                    hasAnyPermission([
                        'master.customers.index',
                        'master.branches.index',
                        'master.divisions.index',
                        'master.salesmans.index',
                    ])
                "
            >
                <a
                    class="nav-link collapsed"
                    data-bs-target="#master-nav"
                    data-bs-toggle="collapse"
                    href="#"
                >
                    <i class="bi bi-journal-text"></i>
                    <span>Master</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="master-nav"
                    class="nav-content collapse"
                    data-bs-parent="#sidebar-nav"
                >
                    <li v-if="hasAnyPermission(['master.customers.index'])">
                        <Link href="/customers">
                            <i class="bi bi-circle"></i><span>Pelanggan</span>
                        </Link>
                    </li>
                    <li v-if="hasAnyPermission(['master.branches.index'])">
                        <Link href="/branches">
                            <i class="bi bi-circle"></i><span>Cabang</span>
                        </Link>
                    </li>
                    <li v-if="hasAnyPermission(['master.divisions.index'])">
                        <Link href="/divisions">
                            <i class="bi bi-circle"></i><span>Divisi</span>
                        </Link>
                    </li>
                    <li v-if="hasAnyPermission(['master.salesmans.index'])">
                        <Link href="/salesmans">
                            <i class="bi bi-circle"></i><span>Salesman</span>
                        </Link>
                    </li>
                </ul>
            </li>

            <li class="nav-item" v-if="hasAnyPermission(['report.stb.index'])">
                <a
                    class="nav-link collapsed"
                    data-bs-target="#report-nav"
                    data-bs-toggle="collapse"
                    href="#"
                >
                    <i class="bi bi-journal-text"></i>
                    <span>Laporan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul
                    id="report-nav"
                    class="nav-content collapse"
                    data-bs-parent="#sidebar-nav"
                >
                    <li v-if="hasAnyPermission(['report.stb.index'])">
                        <a href="#">
                            <i class="bi bi-circle"></i><span>STB</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="nav-heading"
                v-if="
                    hasAnyPermission([
                        'setting.users.index',
                        'setting.roles.index',
                        'setting.permissions.index',
                    ])
                "
            >
                Setting
            </li>

            <li
                class="nav-item"
                v-if="hasAnyPermission(['setting.users.index'])"
            >
                <Link
                    class="nav-link"
                    href="/users"
                    :class="[
                        !$page.url.startsWith('/users') ? 'collapsed' : '',
                    ]"
                >
                    <i class="bi bi-person"></i>
                    <span>Pengguna</span>
                </Link>
            </li>

            <li
                class="nav-item"
                v-if="hasAnyPermission(['setting.roles.index'])"
            >
                <Link
                    class="nav-link"
                    href="/roles"
                    :class="[
                        !$page.url.startsWith('/roles') ? 'collapsed' : '',
                    ]"
                >
                    <i class="bi bi-question-circle"></i>
                    <span>Role</span>
                </Link>
            </li>

            <li
                class="nav-item"
                v-if="hasAnyPermission(['setting.permissions.index'])"
            >
                <Link
                    class="nav-link"
                    href="/permissions"
                    :class="[
                        !$page.url.startsWith('/permissions')
                            ? 'collapsed'
                            : '',
                    ]"
                >
                    <i class="bi bi-envelope"></i>
                    <span>Izin</span>
                </Link>
            </li>
        </ul>
    </aside>
</template>
