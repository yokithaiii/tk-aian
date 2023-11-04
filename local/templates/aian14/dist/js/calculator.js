console.dir("from calc.js");
const {createApp, ref, onMounted} = Vue;
// import { ref, onMounted, createApp } from 'vue';

createApp({
    setup() {
        const showDropdown = ref(null); // null означает, что ни один дропдаун не открыт
        const data = ref(null); // Инициализируем переменную для хранения данных
        const isLoading = ref(false); // Переменная для отслеживания состояния загрузки
        const error = ref(null); // Переменная для хранения возможной ошибки при запросе

        // Метод для получения данных с сервера
        const fetchData = async () => {
            isLoading.value = true; // Начинаем загрузку
            try {
                const response = await fetch("http://aian14.ru/api/tariffs/");
                if (!response.ok) {
                    throw new Error("Ошибка сети");
                }
                const json = await response.json();
                data.value = json.data; // Присваиваем полученные данные переменной
            } catch (e) {
                error.value = e; // В случае ошибки сохраняем ее в переменной
            } finally {
                isLoading.value = false; // Загрузка завершена
            }
        };

        // Получаем данные при монтировании компонента

        // Функция для переключения дропдауна
        function toggleDropdown(index) {
            showDropdown.value = showDropdown.value === index ? null : index;
        }

        // Представим, что этот массив данных приходит с сервера
        const options = ref({
            data: [],
        });

        // Верните переменные и методы, которые будут доступны в шаблоне
        onMounted(() => {
            fetchData();
        });
        return {
            options,
            showDropdown,
            toggleDropdown,
            data,
            isLoading,
            error,
            fetchData
        };
    },
}).mount("#app");
