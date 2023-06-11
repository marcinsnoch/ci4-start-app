const { Plugins, PluginsDir } = require("./Plugins");
const fse = require("fs-extra");

class Publish {
    constructor() {
        this.options = {
            verbose: false
        };

        this.getArguments();
    }

    getArguments() {
        if (process.argv.length > 2) {
            let arg = process.argv[2];
            switch (arg) {
                case "-v":
                case "--verbose":
                    this.options.verbose = true;
                    break;
                default:
                    throw new Error(`Unknown option ${arg}`);
            }
        }
    }

    run() {
        // Remove previous files
        if (fse.pathExists(PluginsDir)) {
            fse.removeSync(PluginsDir);

            if (this.options.verbose) {
                console.log(`Removed folder: ${PluginsDir}`);
            }
        }
        // Publish files
        Plugins.forEach((module) => {
            try {
                if (fse.pathExists(PluginsDir)) {
                    fse.copySync(module.from, PluginsDir + module.toPluginsDir);
                } else {
                    fse.copySync(
                        module.from.replace("node_modules/", "../"),
                        PluginsDir + module.toPluginsDir
                    );
                }

                if (this.options.verbose) {
                    console.log(
                        `Copied ${module.from} to ${PluginsDir + module.toPluginsDir}`
                    );
                }
            } catch (err) {
                console.error(`Error: ${err}`);
            }
        });
    }
}

new Publish().run();
