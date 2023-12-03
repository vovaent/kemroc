/**
 * External dependencies
 */
const path = require('path');

/**
 * WordPress Dependencies
 */
const defaultConfig = require('@wordpress/scripts/config/webpack.config.js');

/**
 * Internal dependencies
 */

const userConfig = {
    entry: {
        "scripts": path.resolve(process.cwd(), "js/scripts.js"),
    },
    output: {
        filename: '[name].js',
        path: path.resolve(process.cwd(), 'js/build'),
    },
};

const config = {
    ...defaultConfig,
    ...{
        entry: { ...defaultConfig.entry, ...userConfig.entry },
        output: { ...defaultConfig.output, ...userConfig.output },
    },
};

module.exports = config;