/*
При загрузке страницы мы находим все элементы с классом .faq__item.
На каждый вопрос (.faq__question) добавляется обработчик событий, который переключает класс active у родительского элемента .faq__item при щелчке.
Это приводит к отображению или скрытию ответа.
*/

document.addEventListener("DOMContentLoaded", function () {
  const faqItems = document.querySelectorAll(".faq__item");

  faqItems.forEach(function (item) {
    const question = item.querySelector(".faq__question");

    question.addEventListener("click", function () {
      item.classList.toggle("active");
    });
  });
});
