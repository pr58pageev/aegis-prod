;(function () {
    document.addEventListener('DOMContentLoaded', function() {


       

        let header = {};
        header.block = document.getElementById('header-two');
        header.heigth = header.block.offsetHeight;
     
        header.headerCard = header.block.querySelector('.window_basket');
        

        

        let BXpanel = document.querySelector('.bx-panel-fixed');

        let searchBlock = null;
        let searchForm = null;

        document.addEventListener('DOMContentLoaded', function() {
            searchBlock = document.querySelector('.title-search-result');
            searchBlock.addEventListener('wheel', function (evt) {
                evt.preventDefault();
            });
            searchForm = document.querySelector('#search');
        });

        if(header.headerCard) {
            header.headerCard.addEventListener('wheel', function (evt) {
                evt.preventDefault();
            });
        }

        function handlerScroll() {
            if (window.pageYOffset > header.heigth) {
                header.block.classList.add('fix-header-two');
                header.block.nextElementSibling.style.paddingTop = header.heigth + "px";

                if(BXpanel) {
                    header.block.style.top = BXpanel.offsetHeight + 'px';
                } else {
                    header.block.style.top = "";
                }

                if (searchBlock && searchForm) {
                    searchForm.appendChild(searchBlock);
                    searchBlock.classList.add('fixed');
                }


            } else {
                header.block.classList.remove('fix-header-two');
                header.block.style.top = "";
               
                header.block.nextElementSibling.style.paddingTop = "";

                if (searchBlock) {
                    searchBlock.classList.remove('fixed');
                    header.block.parentNode.appendChild(searchBlock);
                    searchBlock.style.display = 'none';
                }
            }
        };

        

        function addFixedHeader () {
            window.addEventListener('scroll', handlerScroll);
            if (window.pageYOffset > header.heigth) {
                header.block.classList.add('fix-header-two');
            } else {
                header.block.classList.remove('fix-header-two');
            }
        }

        function removeFixedHeader () {
            window.removeEventListener('scroll', handlerScroll);
            header.block.classList.remove('fix-header-two');
            header.block.nextElementSibling.style.paddingTop = "";
        }


        function addMobileFixedHeader () {
            if (window.innerWidth < 768) {
                addFixedHeader();

            } else {
                removeFixedHeader();
            }
        }

        function addDesktopFixedHeader () {
            if (window.innerWidth >= 768) {
                addFixedHeader();

            } else {
                removeFixedHeader();
            }
        }

        window.fixedHeader = function (params) {
            if(params === 'mobile') {
                addMobileFixedHeader ();
                window.addEventListener('resize', addMobileFixedHeader);
            }

            if(params === 'desktop') {
                addDesktopFixedHeader ();
                window.addEventListener('resize', addDesktopFixedHeader);
            }

            if(params === 'all') {
                window.removeEventListener('resize', addDesktopFixedHeader);
                window.removeEventListener('resize', addMobileFixedHeader);
                addFixedHeader();
            }

            if(params === 'del') {
                window.removeEventListener('resize', addDesktopFixedHeader);
                window.removeEventListener('resize', addMobileFixedHeader);
                removeFixedHeader();
            }
        }
    });
})();

