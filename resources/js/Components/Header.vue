<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="/admin/img/logo.png" alt="" />
                <span class="d-none d-lg-block">Fuboru</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="search-bar">
            <form
                class="search-form d-flex align-items-center"
                method="POST"
                action="#"
            >
                <input
                    type="text"
                    name="query"
                    placeholder="Search"
                    title="Enter search keyword"
                />
                <button type="submit" title="Search">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
        <!-- End Search Bar -->

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
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="users-profile.html"
                            >
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="users-profile.html"
                            >
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>

                        <li>
                            <a
                                class="dropdown-item d-flex align-items-center"
                                href="pages-faq.html"
                            >
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
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
