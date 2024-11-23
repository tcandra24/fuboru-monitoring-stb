import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";

// import { ZiggyVue } from "ziggy-js";
// import { ZiggyVue } from "ziggy-js";
// import { Ziggy } from "./ziggy.js";
import moment from "moment";
import "moment/locale/id";

import { InertiaProgress } from "@inertiajs/progress";

createInertiaApp({
    // resolve: (name) => require(`./Pages/${name}`),
    resolve: (name) => {
        const context = require.context("./Pages", true, /\.vue$/);
        const page = context(`./${name}.vue`);
        return page.default;
    },
    setup({ el, App, props, plugin }) {
        const application = createApp({ render: () => h(App, props) })
            .mixin({
                methods: {
                    hasAnyPermission: function (permissions) {
                        let allPermissions = this.$page.props.auth.permissions;

                        let hasPermission = false;
                        permissions.forEach(function (item) {
                            if (allPermissions[item]) hasPermission = true;
                        });

                        return hasPermission;
                    },
                    ucwords: function (string) {
                        return string
                            .toLowerCase()
                            .replace(/\b[a-z]/g, function (letter) {
                                return letter.toUpperCase();
                            });
                    },
                    moneyFormat(number) {
                        let val = (number / 1).toFixed(2).replace(".", ",");
                        return val
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    },
                    date_format: function (value) {
                        return moment(value).format("DD MMMM YYYY");
                    },
                },
            })
            .use(plugin)
            // .use(ZiggyVue, Ziggy)
            .mount(el);

        delete el.dataset.page;
        return application;
    },
});

InertiaProgress.init();
