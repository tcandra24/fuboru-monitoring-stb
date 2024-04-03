<script setup>
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    pagination_links: Object,
});
</script>

<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li
                v-for="(link, index) of pagination_links.links"
                class="page-item"
                :class="[link.active ? 'active' : '']"
            >
                <Link
                    v-if="index === 0"
                    :href="link.url === null ? '#' : link.url"
                    class="page-link"
                >
                    Previous
                </Link>
                <Link
                    v-else-if="index === pagination_links.links.length - 1"
                    :href="link.url === null ? '#' : link.url"
                    class="page-link"
                >
                    Next
                </Link v-else class="page-link" :href="link.url === null ? '#' : link.url" v-html="link.label">
                <Link>
                </Link>
            </li>
        </ul>
    </nav>
</template>
