<template>
    <div class="flex items-center justify-between py-4">
        <button class="bg-red-500 text-white p-2" v-on:click.prevent="ToCart">Ajouter au panier</button>
    </div>
</template>

<script setup>
import useProducts from '../composables/products';
import emitter from 'tiny-emitter/instance';

const { add } = useProducts();

const productId = defineProps(['productId']);


const ToCart = async () => {
    await axios.get('/sanctum/csrf-cookie');
    await axios.get('api/user')
        .then(async (res) => {
            let cartCount = await add(productId);

            emitter.emit('cartCountUpdated', cartCount)


        })
        .catch(err => console.log(err));
}
</script>