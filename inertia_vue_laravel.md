________________________________________instalação server side_________________________
## 1 - composer require inertiajs/inertia-laravel
## 2 - implemente a view em resources\views\app.blade.php:
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>

## 3 - php artisan inertia:middleware
## 4 -  em app\Http\Kernel.php 
     insira na Middleware 'web' => 
     \App\Http\Middleware\HandleInertiaRequests::class

_________________________________________instalação client side______________________________
Verificar versão dos plugins:
npm info @inertiajs/vue3
npm info @vitejs/plugin-vue
npm info laravel-vite-plugin
________________________________________
npm install @inertiajs/vue3
npm install @vitejs/plugin-vue
npm install laravel-vite-plugin


## 2 - crie os diretorios e arquivos necessários em:
resources\js\Pages

## 2.1 -  implemente em resources\js\app.js
import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/vue3';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    return pages[`./Pages/${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });
    app.use(plugin);
    app.component('Link', Link);
    app.mount(el);
  },
});

## 3 - npm install vue

## 4 - implementando a chamada com vite.config.js:
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';  // Import the vue plugin here
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css','resources/js/app.js'],
            refresh: true,  
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '@assets': '/public/assets', // Adicione esta linha

        },
    },
});

## 5 - limpe o cache:
npm cache clean --force

## 6  - Quando o InertiaJS é usado com Vue, ao clicar em um <Link>, o Inertia faz uma requisição para o servidor para buscar os dados no formato JSON (não HTML), e então atualiza a página dinamicamente com esses dados.
configure em app.js:
import { createInertiaApp, Link } from '@inertiajs/vue3'  // Importação correta do Link em app.js
.component('Link', Link) // Registra o Link globalmente
ex:<Link href="\login">Log in</Link >

## 6.1  - Defina a Rota no Laravel web.php:
use Inertia\Inertia;

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');


## 6.2 instale flowbite:
npm install flowbite

## 6.2 
npx @tailwindcss/cli -i main.css -o public\assets\css\app.css

## implemente tailwind.config.js
personalizar tailwind

## 6 - npm run dev
-------
Observações:

## 1 - para atualizar o package.json execute: npm update

## 2 - verificar inconsistências: composer audit

## 3 - corrigir falha do pacote: composer update league/commonmark

_________________________________
PARA ATUALIZADO O NODE ACESSE CMD 

## 1- Listar versões disponível
nvm list available

## 2 - Insira a versão ex:
nvm install 22.5.1

## 3 - selecione a versão instalada:
nvm use 22.5.1

## 4 - Procure o node.exe e coloque na var de ambiente:
C:\Program Files\nodejs
_______________________________
