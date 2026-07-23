document.addEventListener('DOMContentLoaded', () => {
    // تصفية البحث الحية لطلبات الاحتياجات
    const searchInput = document.getElementById('searchRequest');
    if (searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.request-card');

            cards.forEach(card => {
                const text = card.innerText.toLowerCase();
                if (text.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});