<template>
    <div class="flex items-center justify-between py-4">
        <button class="bg-red-500 text-white p-2" v-on:click.prevent="ToCart">Ajouter au panier</button>
    </div>
</template>

<script setup>
import { inject } from 'vue';
import useProducts from '../composables/products';
import emitter from 'tiny-emitter/instance';

const { add } = useProducts();

const productId = defineProps(['productId']);

const toast = inject('toast');



const ToCart = async () => {
    await axios.get('/sanctum/csrf-cookie');
    await axios.get('api/user')
    .then(async (res) => {
        let cartCount = await add(productId);
        emitter.emit('cartCountUpdated', cartCount);
        toast.success('Produit ajouté au panier.');
        
        
    })
    .catch(() => {
        toast.error('Merci de vous connecter pour ajouter un produit au panier.');
        });
}
</script>