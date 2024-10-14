import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

let savedPaginationInfos = JSON.parse(localStorage.getItem('paginationInfos'));

if (savedPaginationInfos && !window.location.pathname.includes(savedPaginationInfos.currentPath)) {
    localStorage.removeItem('paginationInfos');
}

savedPaginationInfos = JSON.parse(localStorage.getItem('paginationInfos'));

if (savedPaginationInfos && window.location.pathname === savedPaginationInfos.currentPath && !window.location.search) {
    window.location.search = `?page=${savedPaginationInfos.currentPage}`;
}

window.onload = () => {
    const paginationLinks = document.querySelectorAll('a.page-link');

    paginationLinks.forEach(link => {
        link.addEventListener('click', function (clickEvent) {
            const targetUrl = new URL(link.getAttribute('href'));
            const targetPage = targetUrl.searchParams.get('page');

            if (targetPage) {
                const paginationInfos = {};
                paginationInfos.currentPage = targetPage;
                paginationInfos.currentPath = window.location.pathname;

                console.log(paginationInfos.currentPage);

                localStorage.setItem('paginationInfos', JSON.stringify(paginationInfos));
            }
        });

    });
};
