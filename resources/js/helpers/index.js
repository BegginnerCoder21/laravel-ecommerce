export const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'XOF',
    }).format(price/10);
}

export const saveOrders = async () => {

  await  axios.post('/saveOrders');
}