import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import path from 'path';
import fs from 'fs';

const symlinkImages = ({ imagesPath }: { imagesPath: string }) => ({
  name: 'symlink-images',
  configureServer(server) {
    const buildPath = server.config.build.outDir;
    const publicImagesPath = path.resolve(buildPath, 'images');

    if (!fs.existsSync(buildPath)) {
      fs.mkdirSync(buildPath, { recursive: true });
    }

    // Remove existing path (symlink or directory)
    if (fs.existsSync(publicImagesPath)) {
      try {
        fs.rmSync(publicImagesPath, { recursive: true });
        console.log(`🗑️ Removed existing symlink or path: ${publicImagesPath}`);
      } catch (err) {
        console.error('❌ Failed to remove existing path:', err.message);
      }
    }

    // Create new symlink
    try {
      const fullImagesPath = path.resolve(server.config.root, imagesPath);
      fs.symlinkSync(fullImagesPath, publicImagesPath, 'dir');
      console.log(`✅ Symlink created: ${publicImagesPath} → ${fullImagesPath}`);
    } catch (err) {
      console.error('❌ Failed to create symlink:', err.message);
    }
  },
});

export default defineConfig({
  plugins: [
    vue(),
    laravel({
      input: ['resources/assets/css/shop.css', 'resources/assets/js/shop.js'],
      refresh: true,
      buildDirectory: 'themes/shop/visual-velocity',
      hotFile: 'public/themes/shop/visual-velocity/visual-velocity-vite.hot',
    }),
    symlinkImages({ imagesPath: 'resources/assets/images' }), // symlink images for dev
    viteStaticCopy({
      targets: [
        {
          src: 'resources/assets/images/*',
          dest: 'images',
        },
      ],
    }),
  ],
  define: {
    __VUE_OPTIONS_API__: true,
    __VUE_PROD_DEVTOOLS__: false,
    __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
  },
});
