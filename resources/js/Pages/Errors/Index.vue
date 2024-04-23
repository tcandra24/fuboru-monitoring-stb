<script setup>
import LayoutError from "../../Layouts/Error.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
const props = defineProps({
    status: Number,
    message: String,
});
</script>

<template>
    <Head>
        <title>{{ status }} - Monitoring STB</title>
    </Head>

    <LayoutError>
        <h1>{{ status }}</h1>
        <h2>{{ message }}</h2>
        <Link href="/" class="btn"> Kembali </Link>
        <img
            src="/admin/img/not-found.svg"
            class="img-fluid py-5"
            alt="Page Not Found"
        />
        <div class="credits">
            Dibuat oleh
            <a
                href="https://fuboru.co.id/"
                target="_blank"
                ref="nofollow noopener"
                >Fuboru Indonesia</a
            >
        </div>
    </LayoutError>
</template>
