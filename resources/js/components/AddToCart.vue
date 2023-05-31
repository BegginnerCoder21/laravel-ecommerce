<template>
    <div class="flex items-center justify-between py-4">
        <button class="bg-red-500 text-white p-2" v-on:click.prevent="ToCart">Ajouter au panier</button>
    </div>
</template>

<script setup>
const productId = defineProps(['productId']);

const ToCart = async () => {
    await axios.get('/sanctum/csrf-cookie');
    await axios.get('api/user')
        .then(async (res) => {
            let response =await axios.post('api/products', {
                productId: productId
            });
            console.log(response);

        })
        .catch(err => console.log(err));
}
</script>