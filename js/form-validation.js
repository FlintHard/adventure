document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".booking__form");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Останавливаем стандартную отправку формы

    // Получаем значения полей
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const tour = document.getElementById("tour").value;

    // Проверка валидации полей
    if (name === "") {
      alert("Введите ваше имя");
      return;
    }

    if (email === "" || !validateEmail(email)) {
      alert("Введите корректный email");
      return;
    }

    // Подготовка данных для отправки
    const formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("tour", tour);

    // Отправляем данные на сервер через AJAX
    fetch("php/submit_booking.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((result) => {
        alert("Ваш заказ успешно отправлен!");
        form.reset(); // Сброс формы после успешной отправки
      })
      .catch((error) => {
        console.error("Ошибка:", error);
        alert("Произошла ошибка при отправке формы");
      });
  });

  // Функция для проверки корректности email
  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }
});
