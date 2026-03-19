document.addEventListener("DOMContentLoaded", function() {

        const unitPrice = parseFloat("<?php echo $product['price']; ?>");

        window.updateQty = function(change) {
            let qty = parseInt(document.getElementById('display-qty').value);
            qty = qty + change;

            if (qty < 1) qty = 1;

            const unitPrice = Number(document.getElementById("unit-price").value);
            const total = qty * unitPrice;

            const totalFormatted = total.toLocaleString('vi-VN') + 'đ';

            document.getElementById('display-qty').value = qty;
            document.getElementById('total-display').innerText = totalFormatted;

            const tableQty = document.getElementById('table-qty');
            const tableTotal = document.getElementById('table-total');

            if (tableQty) tableQty.innerText = qty;
            if (tableTotal) tableTotal.innerText = totalFormatted;

            document.getElementById('form-qty').value = qty;
            document.getElementById('form-amount').value = total;
        }

        const nameInput = document.querySelector('[name="customer_name"]');
        const emailInput = document.querySelector('[name="customer_email"]');
        const phoneInput = document.querySelector('[name="customer_phone"]');
        const addressInput = document.querySelector('[name="customer_address"]');
        const btn = document.getElementById('submitBtn');
        const form = document.getElementById('checkoutForm');

        function checkForm() {
            if (
                nameInput.value.trim() &&
                emailInput.value.trim() &&
                phoneInput.value.trim() &&
                addressInput.value.trim()
            ) {
                btn.disabled = false;
                btn.style.opacity = "1";
            } else {
                btn.disabled = true;
                btn.style.opacity = "0.5";
            }
        }

        [nameInput, emailInput, phoneInput, addressInput].forEach(input => {
            input.addEventListener("input", checkForm);
        });

        form.addEventListener("submit", function(e) {
            if (!form.checkValidity()) {
                form.reportValidity();
                e.preventDefault();
                return;
            }

            const method = document.querySelector('input[name="payment_choice"]:checked').value;

            if (method === 'cod') {
                form.action = "create_order.php";
            } else {
                form.action = "vnpay_php/vnpay_create_payment.php";
            }
        });

    });