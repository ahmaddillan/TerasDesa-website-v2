document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const selectAll = document.getElementById('selectAll');
    const totalPriceEl = document.getElementById('totalPrice');
    const checkoutForm = document.getElementById('checkoutForm');
    const cartDataInput = document.getElementById('cartData');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    function getCartItems() {
        return document.querySelectorAll('.cart-item');
    }

    function formatRupiah(num) {
        return 'Rp' + num.toLocaleString('id-ID');
    }

    function updateTotal() {
        let total = 0;

        getCartItems().forEach(item => {
            const cb = item.querySelector('.item-checkbox');
            const qty = parseInt(item.querySelector('.qty-value').innerText);
            const price = parseInt(cb.dataset.price);

            if (cb.checked) total += price * qty;
        });

        totalPriceEl.innerText = formatRupiah(total);
    }

    // SEARCH
    if (searchInput) {
        searchInput.addEventListener('keyup', () => {
            const keyword = searchInput.value.toLowerCase();
            getCartItems().forEach(item => {
                const name = item.querySelector('.product-name').innerText.toLowerCase();
                item.style.display = name.includes(keyword) ? 'flex' : 'none';
            });
        });
    }

    // SELECT ALL
    if (selectAll) {
        selectAll.addEventListener('change', () => {
            document.querySelectorAll('.item-checkbox')
                .forEach(cb => cb.checked = selectAll.checked);
            updateTotal();
        });
    }

    // ITEM CHECKBOX
    document.querySelectorAll('.item-checkbox').forEach(cb => {
        cb.addEventListener('change', updateTotal);
    });

    // QTY + API SYNC
    getCartItems().forEach(item => {
        const plus = item.querySelector('.btn-plus');
        const minus = item.querySelector('.btn-minus');
        const qtyEl = item.querySelector('.qty-value');
        const itemId = item.dataset.id;

        plus.addEventListener('click', () => {
            const qty = parseInt(qtyEl.innerText) + 1;
            qtyEl.innerText = qty;
            updateQty(itemId, qty);
            updateTotal();
        });

        minus.addEventListener('click', () => {
            let qty = parseInt(qtyEl.innerText);
            if (qty > 1) {
                qty--;
                qtyEl.innerText = qty;
                updateQty(itemId, qty);
                updateTotal();
            }
        });
    });

    function updateQty(itemId, qty) {
        fetch(`/cart/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({ quantity: qty })
        });
    }

    // SUBMIT CHECKOUT
    checkoutForm.addEventListener('submit', () => {
        let data = [];

        getCartItems().forEach(item => {
            const cb = item.querySelector('.item-checkbox');
            if (cb.checked) {
                const qty = parseInt(item.querySelector('.qty-value').innerText);
                const price = parseInt(cb.dataset.price);
                const name = item.querySelector('.product-name').innerText;
                const image = item.dataset.image;

                data.push({
                    name,
                    price,
                    qty,
                    subtotal: price * qty,
                    image
                });
            }
        });

        cartDataInput.value = JSON.stringify(data);
    });

    updateTotal();
});
