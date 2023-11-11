console.dir("from calc.js");
const { createApp, ref, onMounted, onBeforeMount, onUnmounted } = Vue;
// import { ref, onMounted, createApp } from 'vue';
if (document.querySelector("#app")) {
    createApp({
        setup() {
            const showDropdown = ref(null);
            const data = ref(null);
            const isLoading = ref(false);
            const error = ref(null);
            const selectedCategory = ref(null);
            const selectedCity = ref({});
            const selectedCategoryItems = ref([]);

            const weigth = ref(0);
            const volume = ref(0);

            const fromIndexPageState = ref(false);

            // Метод для получения данных с сервера
            const fetchData = async () => {
                isLoading.value = true;
                try {
                    const response = await fetch(
                        "https://aian14.ru/api/tariffs/"
                    );
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

            // Функция для переключения дропдауна
            function toggleDropdown(index) {
                showDropdown.value =
                    showDropdown.value === index ? null : index;
            }

            const pickOtpravka = (category) => {
                summ.value.active = false;
                selectedCity.value = {};
                selectedCategory.value = category;
                selectedCategoryItems.value = category.items;
                showDropdown.value = null; // Скрыть текущий дропдаун
            };

            const pickCity = (city) => {
                if (city == "other") {
                    summ.value.other = true;
                    selectedCity.value.name = "Другой город";
                    selectedCity.value.from = "Другой город";
                    selectedCity.value.to = "Якутск";
                    selectedCity.value.tarif_kg = 0;
                    selectedCity.value.tarif_m3 = 0;
                } else {
                    summ.value.other = false;
                    summ.value.active = false;
                    selectedCity.value.name = city.name;
                    selectedCity.value.from = city.from;
                    selectedCity.value.to = city.to;
                    selectedCity.value.tarif_kg = city.tarif_kg;
                    selectedCity.value.tarif_kg = city.tarif_kg;
                    selectedCity.value.tarif_m3 = city.tarif_m3;
                    selectedCity.value.delivery_time = city.delivery_time;
                    // summ.value.time = city.delivery_time;
                }

                showDropdown.value = null;
            };

            const summ = ref({
                price: null,
                time: null,
                active: false,
                other: false,
            });

            const calculate = (page) => {
                if (
                    weigth.value &&
                    selectedCity.value.tarif_kg &&
                    volume.value &&
                    selectedCity.value.tarif_m3
                ) {
                    const weightCost =
                        weigth.value *
                        parseFloat(selectedCity.value.tarif_kg.price);
                    const volumeCost =
                        volume.value *
                        parseFloat(selectedCity.value.tarif_m3.price);
                    summ.value.time = selectedCity.value.delivery_time;

                    // Возвращаем максимальное значение стоимости, учитывая вес и объем
                    summ.value.active = true;

                    if (page == "index") {
                        summ.value.price = Math.max(weightCost, volumeCost);
                        fromIndexPageState.value = true;
                        setToLocalStorage();
                        window.location.href = "/calculate-cost";
                    }
                    return (summ.value.price = Math.max(
                        weightCost,
                        volumeCost
                    ));
                }
                summ.value.active = false;
                return null; // Если какие-то значения не заданы, возвращаем null или обрабатываем ошибку
            };

            const setToLocalStorage = () => {
                const pickedData = {
                    summ: summ.value?.price,
                    time: summ.value?.time,
                    selectedCity: selectedCity.value?.name,
                    selectedCategory: selectedCategory.value?.name,
                    fromIndexPageState: fromIndexPageState?.value,
                };

                localStorage.setItem(
                    "calculationResult",
                    JSON.stringify(pickedData)
                );
            };

            const clearInput = (event) => {
                if (event.target.value == 0) {
                    event.target.value = "";
                }
            };

            const localData = ref(null);

            onBeforeMount(async () => {
                await fetchData();
            });

            // Верните переменные и методы, которые будут доступны в шаблоне
            onMounted(() => {
                if (window.location.pathname === "/calculate-cost/") {
                    const result = JSON.parse(
                        localStorage.getItem("calculationResult")
                    );

                    localData.value = result;

                    if (result.fromIndexPageState == true) {
                        summ.value.active = true;
                        summ.value.price = result.summ;
                    }
                } else {
                    localStorage.removeItem("calculationResult");
                }
            });
            // onUnmounted(() => {
            //     localStorage.removeItem('calculationResult');
            // });
            return {
                showDropdown,
                toggleDropdown,
                data,
                isLoading,
                error,
                fetchData,
                pickOtpravka,
                selectedCategory,
                selectedCategoryItems,
                selectedCity,
                pickCity,
                weigth,
                volume,
                calculate,
                summ,
                clearInput,
                fromIndexPageState,
                localData,
            };
        },
    }).mount("#app");
}
