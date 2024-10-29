// Функция для загрузки отзывов при загрузке страницы
function loadReviews() {
  fetch("php/get_reviews.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Сеть не отвечает");
      }
      return response.json();
    })
    .then((data) => {
      const reviewsList = document.getElementById("reviews-list");
      reviewsList.innerHTML = ""; // Очищаем текущий список
      data.forEach((review) => {
        const reviewItem = document.createElement("div");
        reviewItem.className = "reviews__item"; // Класс для элемента отзыва

        const reviewName = document.createElement("div");
        reviewName.className = "reviews__item-name"; // Класс для имени
        reviewName.textContent = review.username; // Устанавливаем имя

        const reviewText = document.createElement("div");
        reviewText.className = "reviews__item-text"; // Класс для текста отзыва
        reviewText.textContent = review.comment; // Устанавливаем текст отзыва

        reviewItem.appendChild(reviewName); // Добавляем имя в элемент отзыва
        reviewItem.appendChild(reviewText); // Добавляем текст отзыва в элемент отзыва
        reviewsList.appendChild(reviewItem); // Добавляем элемент отзыва в общий список
      });
    })
    .catch((error) => {
      console.error("Ошибка:", error);
    });
}

// Функция для обработки отправки отзыва
document
  .getElementById("review-form")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Предотвращаем стандартное поведение формы
    const formData = new FormData(this);

    fetch(this.action, {
      method: this.method,
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Сеть не отвечает");
        }
        return response.text(); // Или response.json(), если сервер возвращает JSON
      })
      .then((data) => {
        console.log(data); // Логируем ответ от сервера
        loadReviews(); // Перезагружаем список отзывов после отправки
      })
      .catch((error) => {
        console.error("Ошибка:", error);
      });
  });

// Загрузка отзывов при загрузке страницы
document.addEventListener("DOMContentLoaded", loadReviews);
