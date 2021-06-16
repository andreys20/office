$(document).ready(function() {
    $('.auth').each(function() {
        // Объявляем переменные (форма и кнопка отправки)
        var form = $(this),
            btn = form.find('button');

        // Добавляем каждому проверяемому полю, указание что поле пустое
        form.find('.field_type').addClass('empty');

        // Функция проверки полей формы
        function checkInput() {
            form.find('.field_type').each(function () {
                if ($(this).val() !== '') {
                    // Если поле не пустое удаляем класс-указание
                    $(this).removeClass('empty');
                } else {
                    // Если поле пустое добавляем класс-указание
                    $(this).addClass('empty');
                }
            });
        }

        setInterval(function(){
            // Запускаем функцию проверки полей на заполненность
            checkInput();
            // Считаем к-во незаполненных полей
            var sizeEmpty = form.find('.empty').size();
            // Вешаем условие-тригер на кнопку отправки формы
            if(sizeEmpty > 0){
                if(btn.hasClass('disabled')){
                    return false
                } else {
                    btn.addClass('disabled')
                }
            } else {
                btn.removeClass('disabled')
            }
        },500);
    });
});