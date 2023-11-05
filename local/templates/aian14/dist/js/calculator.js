console.dir("from calc.js");
const {createApp, ref, onMounted} = Vue;
// import { ref, onMounted, createApp } from 'vue';

createApp({
    setup() {
        const showDropdown = ref(null); 
        const data = ref(null); 
        const isLoading = ref(false); 
        const error = ref(null);

        // Метод для получения данных с сервера
        const fetchData = async () => {
            isLoading.value = true; 
            try {
                const response = await fetch("http://aian14.ru/api/tariffs/");
                if (!response.ok) {
                    throw new Error("Ошибка сети");
                }
                const json = await response.json();
                data.value = json.data; 
            } catch (e) {
                error.value = e; 
            } finally {
                isLoading.value = false;
            }
        };

        // Получаем данные при монтировании компонента

        // Функция для переключения дропдауна
        function toggleDropdown(index) {
            showDropdown.value = showDropdown.value === index ? null : index;
        }

        // Верните переменные и методы, которые будут доступны в шаблоне
        onMounted(() => {
            fetchData();
        });
        return {
            showDropdown,
            toggleDropdown,
            data,
            isLoading,
            error,
            fetchData
        };
    },
}).mount("#app");
