import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";

import { InertiaProgress } from "@inertiajs/progress";

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .mixin({
                methods: {
                    hasAnyPermission: function (permissions) {
                        //get permissions from props
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
                },
            })
            .use(plugin)
            .mount(el);
    },
});

InertiaProgress.init();
