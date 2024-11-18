<?php

declare(strict_types=1);

if (file_exists(dirname(__DIR__) . '/var/cache/prod/App_KernelProdContainer.preload.php')) {
    /**
     * Phan error: PhanMissingRequireFile Missing required file "..."
     * False positive, because file existence is checked above.
     *
     * @superss PhanMissingRequireFile
     */
    require dirname(__DIR__) . '/var/cache/prod/App_KernelProdContainer.preload.php';
}
