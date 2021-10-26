(function($){
    $.fn.extend({ 
        MyPagination: function(options) {
            var defaults = {
                height: 400,
                fadeSpeed: 400
            };
            var options = $.extend(defaults, options);

            // Создаем ссылку на объект
            var objContent = $(this);

            // Внутренние переменные
            var fullPages = new Array();
            var subPages = new Array();
            var height = 0;
            var lastPage = 1;
            var paginatePages;

            // Функция инициализации
            init = function() {
                objContent.children().each(function(i){
                    if (height + this.clientHeight > options.height) {
                        fullPages.push(subPages);
                        subPages = new Array();
                        height = 0;
                    }

                    height += this.clientHeight;
                    subPages.push(this);
                });

                if (height > 0) {
                    fullPages.push(subPages);
                }

                // Оборачиваем каждую полную страницу
                $(fullPages).wrap("<div class='page'></div>");

                // Скрываем все обернутые страницы
                objContent.children().hide();

                // Создаем коллекцию для навигации
                paginatePages = objContent.children();

                // Показываем первую страницу
                showPage(lastPage);

                // Выводим элементы управления
                showPagination($(paginatePages).length);
            };

            // Функция обновления счетчика
            updateCounter = function(i) {
                $('#page_number').html(i);
            };

            // Функция вывода страницы
            showPage = function(page) {
                i = page - 1; 
                if (paginatePages[i]) {

                    // Скрываем старую страницу, показываем новую
                    $(paginatePages[lastPage]).fadeOut(options.fadeSpeed);
                    lastPage = i;
                    $(paginatePages[lastPage]).fadeIn(options.fadeSpeed);

                    // и обновлем счетчик
                    updateCounter(page);
                }
            };

            // Функция вывода навигации (выводим номера страниц)
            showPagination = function(numPages) {
                var pagins = '';
                for (var i = 1; i <= numPages; i++) {
                    pagins += '<li><a href="#" onclick="showPage(' + i + '); return false;">' + i + '</a></li>';
                }
                $('.pagination li:first-child').after(pagins);
            };

            // Выполняем инициализацию
            init();

            // Привязываем два события - нажатие на кнопке "Предыдущая страница"
            $('.pagination #prev').click(function() {
                showPage(lastPage);
            });
            // и "Следующая страница"
            $('.pagination #next').click(function() {
                showPage(lastPage+2);
            });

        }
    });
})(jQuery);

// Инициализация 
jQuery(window).load(function() {
    $('#content').MyPagination({height: 400, fadeSpeed: 400});
});