const PluginsDir = "public/plugins/";
const Plugins = [
    // AdminLTE
    {
        from: "node_modules/admin-lte/dist",
        toPluginsDir: "admin-lte"
    },
    // Bootstrap
    {
        from: "node_modules/bootstrap/dist",
        toPluginsDir: "bootstrap"
    },
    // Bootstrap-table
    {
        from: "node_modules/bootstrap-table/dist",
        toPluginsDir: "bootstrap-table"
    },
    // Font Awesome
    {
        from: "node_modules/@fortawesome/fontawesome-free/css",
        toPluginsDir: "fontawesome-free/css"
    },
    {
        from: "node_modules/@fortawesome/fontawesome-free/webfonts",
        toPluginsDir: "fontawesome-free/webfonts"
    },
    // iCheck
    {
        from: "node_modules/icheck-bootstrap",
        toPluginsDir: "icheck-bootstrap"
    },
    // jQuery
    {
        from: "node_modules/jquery/dist",
        toPluginsDir: "jquery"
    },
    // jQuery validation
    {
        from: "node_modules/jquery-validation/dist",
        toPluginsDir: "jquery-validation"
    },
    // Toastr
    {
        from: "node_modules/toastr/build",
        toPluginsDir: "toastr"
    }
];

module.exports = { PluginsDir, Plugins };
