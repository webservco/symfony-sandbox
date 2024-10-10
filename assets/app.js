import './bootstrap.js';

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

/**
 * Tabler (includes Bootstrap)
 */
import '@tabler/core/dist/css/tabler.min.css';
import '@tabler/core';

import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

import moduleTest from './module_test/moduleTest.js';
moduleTest('Test message');