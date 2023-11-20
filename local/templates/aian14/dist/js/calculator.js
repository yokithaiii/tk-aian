
window.addEventListener("load", () => {
    if( document.querySelector("#preloader")) {
        setTimeout(() => {
            preloader.classList.remove("active");
        }, 1500);
    }
});

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

            const localData = ref(null);
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
                localStorage.removeItem("calculationResult");
                localData.value = null;
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
                    selectedCity.value.to = "--/--";
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

                    if (result && result.fromIndexPageState == true) {
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

// const locomotiveScroll = new LocomotiveScroll({
//     lenisOptions: {
//         wrapper: window,
//         content: document.documentElement,
//         lerp: 0.1,
//         duration: 0.4,
//         orientation: "vertical",
//         gestureOrientation: "vertical",
//         smoothWheel: true,
//         smoothTouch: false,
//         wheelMultiplier: 1,
//         touchMultiplier: 2,
//         normalizeWheel: true,
//         easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // https://www.desmos.com/calculator/brs54l4xou
//     },
// });

//Tabs. formalization.html
const TabsBtn = document.querySelectorAll(".l-tab");
const stagesNum = document.querySelectorAll(".stages__num");
const frwButt = document.querySelectorAll(".l-form__button-frw");
const backButt = document.querySelectorAll(".l-form__button-back");

//frwButt.forEach(onFrwClick)
backButt.forEach(onBackClick);

function onFrwClick(cur) {
    cur.addEventListener("click", function (evt) {
        let nextNum = document.querySelector(
            ".stages__num.active"
        ).nextElementSibling;
        let nextTab =
            document.querySelector(".l-tab.active").nextElementSibling;

        stagesNum.forEach(function (item) {
            item.classList.remove("active");
        });

        TabsBtn.forEach(function (item) {
            item.classList.remove("active");
        });

        nextTab.classList.add("active");
        nextNum.classList.add("active");
        updateTabCounter();
    });
}

function onBackClick(cur) {
    cur.addEventListener("click", function (evt) {
        let prevNum = document.querySelector(
            ".stages__num.active"
        ).previousElementSibling;
        let prevTab =
            document.querySelector(".l-tab.active").previousElementSibling;

        stagesNum.forEach(function (item) {
            item.classList.remove("active");
        });

        TabsBtn.forEach(function (item) {
            item.classList.remove("active");
        });

        prevTab.classList.add("active");
        prevNum.classList.add("active");
        updateTabCounter();
    });
}

let check = document.getElementById("privacyCheckbox");
let designBut = document.querySelector(".l-form__button-design");

//document.addEventListener('DOMContentLoaded', displaySubmit)

//check.addEventListener('click', displaySubmit)
//designBut.addEventListener('click', displaySubmit)

// function displaySubmit() {
// 	if (check.checked) {
// 		designBut.disabled = false
// 	} else {
// 		designBut.disabled = true
// 	}
// }

const orderForm = document.querySelector("#order-form");

function validateForm() {
    window.scrollTo(0, 200);
    designBut.disabled = true;
    //First Tab
    const inputsFirstTab = document.querySelectorAll(".input-first-tab");
    const errorsFirstTab = document.querySelectorAll(".error-first-tab");

    //Second Tab
    const inputsSecondTab = document.querySelectorAll(".input-second-tab");
    const errorsSecondTab = document.querySelectorAll(".error-second-tab");

    //Third Tab
    const inputsThirdTab = document.querySelectorAll(".input-third-tab");
    const errorsThirdTab = document.querySelectorAll(".error-third-tab");

    let mark = false;
    let count = 0;
    let findTab = document
        .querySelector(".l-tab.active")
        .getAttribute("data-tab");

    if (findTab === "first") {
        fTab();
    } else if (findTab === "second") {
        sTab();
    } else if (findTab === "third") {
        thTab();
    }

    function fTab() {
        for (let i = 0; i < inputsFirstTab.length; i++) {
            errorsFirstTab[i].innerHTML = "";
            if (inputsFirstTab[i].value === "") {
                errorsFirstTab[i].classList.add("active");
                errorsFirstTab[i].innerHTML = "Обязательное поле";
                mark = false;
            }
            if (inputsFirstTab[i].value != "") {
                errorsFirstTab[i].classList.remove("active");
                count += 1;
            }
        }
        if (count === errorsFirstTab.length) {
            let nextNum = document.querySelector(
                ".stages__num.active"
            ).nextElementSibling;
            let nextTab =
                document.querySelector(".l-tab.active").nextElementSibling;

            stagesNum.forEach(function (item) {
                item.classList.remove("active");
            });

            TabsBtn.forEach(function (item) {
                item.classList.remove("active");
            });

            nextTab.classList.add("active");
            nextNum.classList.add("active");
        }
    }

    function sTab() {
        for (let i = 0; i < inputsSecondTab.length; i++) {
            errorsSecondTab[i].innerHTML = "";
            if (inputsSecondTab[i].value === "") {
                errorsSecondTab[i].classList.add("active");
                errorsSecondTab[i].innerHTML = "Обязательное поле";
                mark = false;
            }
            if (inputsSecondTab[i].value != "") {
                errorsSecondTab[i].classList.remove("active");
                count += 1;
            }
        }
        if (count === errorsSecondTab.length) {
            let nextNum = document.querySelector(
                ".stages__num.active"
            ).nextElementSibling;
            let nextTab =
                document.querySelector(".l-tab.active").nextElementSibling;

            stagesNum.forEach(function (item) {
                item.classList.remove("active");
            });

            TabsBtn.forEach(function (item) {
                item.classList.remove("active");
            });

            nextTab.classList.add("active");
            nextNum.classList.add("active");
        }
    }

    function thTab() {
        for (let i = 0; i < inputsThirdTab.length; i++) {
            errorsThirdTab[i].innerHTML = "";
            if (inputsSecondTab[i].value === "") {
                errorsSecondTab[i].innerHTML.classList.add("active");
                errorsSecondTab[i].innerHTML = "Обязательное поле";
            } else {
                errorsSecondTab[i].innerHTML.classList.remove("active");
            }
        }
    }

    updateTabCounter();
}

function updateTabCounter() {
    let totalTabs = document.querySelectorAll(".stages__num").length;
    let activeTabIndex = Array.from(
        document.querySelectorAll(".stages__num")
    ).indexOf(document.querySelector(".stages__num.active"));
    let counterText = activeTabIndex + 1 + "/" + totalTabs;
    document.getElementById("tabCounter").innerText = counterText;
    console.dir(counterText);
}

const inputsTab = document.querySelectorAll(".input-third-tab");
let validated = false;

inputsTab.forEach((el) => {
    el.addEventListener("input", () => {
        let allFilled = true; // Переменная-флаг

        for (let i = 0; i < inputsTab.length; i++) {
            if (inputsTab[i].value == "") {
                allFilled = false;
                break;
            }
        }
        designBut.disabled = !allFilled;
    });
});
