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
                <Link
                    class="nav-link"
                    data-bs-target="#master-nav"
                    data-bs-toggle="collapse"
                    href="#"
                    :class="[
                        !$page.url.startsWith('/master') ? 'collapsed' : '',
                    ]"
                >
                    <i class="bi bi-view-stacked"></i>
                    <span>Master</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </Link>
                <ul
                    id="master-nav"
                    class="nav-content collapse"
                    data-bs-parent="#sidebar-nav"
                    :class="[$page.url.startsWith('/master') ? 'show' : '']"
                >
                    <li v-if="hasAnyPermission(['master.customers.index'])">
                        <Link
                            href="/master/customers"
                            :class="[
                                $page.url.startsWith('/master/customers')
                                    ? 'active'
                                    : '',
                            ]"
                        >
                            <i class="bi bi-circle"></i><span>Pelanggan</span>
                        </Link>
                    </li>
                    <li v-if="hasAnyPermission(['master.branches.index'])">
                        <Link
                            href="/master/branches"
                            :class="[
                                $page.url.startsWith('/master/branches')
                                    ? 'active'
                                    : '',
                            ]"
                        >
                            <i class="bi bi-circle"></i><span>Cabang</span>
                        </Link>
                    </li>
                    <li v-if="hasAnyPermission(['master.divisions.index'])">
                        <Link
                            href="/master/divisions"
                            :class="[
                                $page.url.startsWith('/master/divisions')
                                    ? 'active'
                                    : '',
                            ]"
                        >
                            <i class="bi bi-circle"></i><span>Divisi</span>
                        </Link>
                    </li>
                    <li v-if="hasAnyPermission(['master.salesmans.index'])">
                        <Link
                            href="/master/salesmans"
                            :class="[
                                $page.url.startsWith('/master/salesmans')
                                    ? 'active'
                                    : '',
                            ]"
                        >
                            <i class="bi bi-circle"></i><span>Salesman</span>
                        </Link>
                    </li>
                </ul>
            </li>

            <li class="nav-item" v-if="hasAnyPermission(['report.stb.index'])">
                <Link
                    class="nav-link"
                    data-bs-target="#report-nav"
                    data-bs-toggle="collapse"
                    href="#"
                    :class="[
                        !$page.url.startsWith('/report') ? 'collapsed' : '',
                    ]"
                >
                    <i class="bi bi-file"></i>
                    <span>Laporan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </Link>
                <ul
                    id="report-nav"
                    class="nav-content collapse"
                    data-bs-parent="#sidebar-nav"
                    :class="[$page.url.startsWith('/report') ? 'show' : '']"
                >
                    <li v-if="hasAnyPermission(['report.stb.index'])">
                        <Link
                            href="/report/stb"
                            :class="[
                                $page.url.startsWith('/report/stb')
                                    ? 'active'
                                    : '',
                            ]"
                        >
                            <i class="bi bi-circle"></i><span>STB</span>
                        </Link>
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
                    href="/setting/users"
                    :class="[
                        !$page.url.startsWith('/setting/users')
                            ? 'collapsed'
                            : '',
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
                    href="/setting/roles"
                    :class="[
                        !$page.url.startsWith('/setting/roles')
                            ? 'collapsed'
                            : '',
                    ]"
                >
                    <i class="bi bi-gear"></i>
                    <span>Role</span>
                </Link>
            </li>

            <li
                class="nav-item"
                v-if="hasAnyPermission(['setting.permissions.index'])"
            >
                <Link
                    class="nav-link"
                    href="/setting/permissions"
                    :class="[
                        !$page.url.startsWith('/setting/permissions')
                            ? 'collapsed'
                            : '',
                    ]"
                >
                    <i class="bi bi-door-closed"></i>
                    <span>Izin</span>
                </Link>
            </li>
        </ul>
    </aside>
</template>
