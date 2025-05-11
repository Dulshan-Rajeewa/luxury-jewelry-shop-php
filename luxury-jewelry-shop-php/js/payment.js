const buyNowButtons = document.querySelectorAll('.buy-now');
const paymentModal = document.querySelector('.payment');
const closeBtn = document.querySelector('.close');

buyNowButtons.forEach(button => {
    button.addEventListener('click', () => {
        paymentModal.style.display = 'flex';
    });
});

closeBtn.addEventListener('click', () => {
    paymentModal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === paymentModal) {
        paymentModal.style.display = 'none';
    }
});
