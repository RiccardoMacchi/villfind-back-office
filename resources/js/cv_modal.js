document.addEventListener('DOMContentLoaded', function () {
    const viewCvBtn = document.getElementById('viewCvBtn');
    const closeCvBtn = document.getElementById('closeCvBtn');
    const cvModal = document.getElementById('cvModal');

    if (viewCvBtn) {
        viewCvBtn.addEventListener('click', function () {
            cvModal.classList.add('show');
        });
    }

    if (closeCvBtn) {
        closeCvBtn.addEventListener('click', function () {
            cvModal.classList.remove('show');
        });
    }
});
